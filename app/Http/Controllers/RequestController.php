<?php

namespace App\Http\Controllers;

use App\Actions\ChangeRequestStatus;
use App\Actions\UploadDocumentation;
use App\Contracts\RequestRepository;
use App\Exceptions\TransitionNotAllowedException;
use App\Models\JobOffer;
use App\Models\Request;
use App\Models\ScholarshipOffer;
use App\Patterns\State\Request\RequestStatus;
use InvalidArgumentException;
use Illuminate\Validation\ValidationException;

class RequestController extends Controller {

	public function __construct(private readonly RequestRepository $repository){}

	public function index(){
		$requests = $this->repository->getAllPendingPaginated();
		return view('admin.requests.index', compact('requests'));
	}

	public function edit(Request $request){
		return view('admin.requests.edit', compact('request'));
	}

	public function document_confirm(Request $request){
		return view('admin.requests.document', compact('request'));
	}

	public function document(int $requestId){
		try {
			$request = $this->repository->findById($requestId);
			$this->commentAndTransition($request, RequestStatus::Documentation);
			return $this->returnToIndex($request);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			return back()->withErrors($exception->getMessage());
		}
	}

	public function accept_confirm(Request $request){
		return view('admin.requests.accept', compact('request'));
	}

	public function accept(int $requestId){
		try {
			$request = $this->repository->findById($requestId);
			$this->commentAndTransition($request, RequestStatus::Accepted);
			return $this->returnToIndex($request);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			return back()->withErrors($exception->getMessage());
		}
	}

	public function reject_confirm(Request $request){
		return view('admin.requests.reject', compact('request'));
	}

	public function reject(int $requestId){
		try {
			$request = $this->repository->findById($requestId);
			$this->commentAndTransition($request, RequestStatus::Rejected);
			return $this->returnToIndex($request);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			return back()->withErrors($exception->getMessage());
		}
	}

	public function review(int $requestId){
		try {
			request()->validate([
				'files' => ['array', 'required'],
				'files.*' => ['mimes:pdf', 'max:8000'],
			]);
			$request = $this->repository->findById($requestId);
			$this->commentAndTransition($request, RequestStatus::Pending);
			$this->uploadDocumentation($request);
			return response()->json([
				'message' => 'Your documentation has been submitted for review successfully.'
			]);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			throw ValidationException::withMessages([
				'comments' => $exception->getMessage()
			]);
		}
	}

	/**
	 * @throws InvalidArgumentException|TransitionNotAllowedException
	 */
	private function commentAndTransition(Request $request, RequestStatus $status){
		ChangeRequestStatus::execute($request, $status);
		if(request()->has('comments') && !empty(request('comments'))){
			$validated = request()->validate([
				'comments' => ['string', 'required']
			]);
			$request->comments()->create([
				'user_id' => auth()->id(),
				'comments' => $validated['comments']
			]);
		}
	}

	private function uploadDocumentation(Request $request){
		UploadDocumentation::execute($request);
	}

	private function returnToIndex(Request $request){
		if($request->offer_type == JobOffer::class){
			return redirect()->route('requests.job.index');
		}
		if($request->offer_type == ScholarshipOffer::class){
			return redirect()->route('requests.scholarship.index');
		}
		return redirect()->route('requests.index');
	}

	public function find(int $requestId){
		return response()->json($this->repository->findById($requestId));
	}

	public function all(){
		return response()->json($this->repository->getAll());
	}

	public function pending(){
		return response()->json($this->repository->getAllPending());
	}

	public function documentation(){
		return response()->json($this->repository->getAllDocumentation());
	}

	public function accepted(){
		return response()->json($this->repository->getAllAccepted());
	}

	public function rejected(){
		return response()->json($this->repository->getAllRejected());
	}

	public function allPaginated(){
		return response()->json($this->repository->getAllPaginated());
	}

	public function pendingPaginated(){
		return response()->json($this->repository->getAllPendingPaginated());
	}

	public function documentationPaginated(){
		return response()->json($this->repository->getAllDocumentationPaginated());
	}

	public function acceptedPaginated(){
		return response()->json($this->repository->getAllAcceptedPaginated());
	}

	public function rejectedPaginated(){
		return response()->json($this->repository->getAllRejectedPaginated());
	}

}
