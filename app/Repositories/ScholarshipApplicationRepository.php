<?php

namespace App\Repositories;

use App\Contracts\ApplicationRepository;
use App\Models\ScholarshipOffer;
use App\Models\Application;
use App\Patterns\State\Request\ApplicationStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ScholarshipApplicationRepository implements ApplicationRepository {

	public function findById(int $id):Application{
		return Application::whereOfferType(ScholarshipOffer::class)->whereId($id)->firstOrFail();
	}

	public function getAll():array|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->latest()->get();
	}

	public function getAllPending():array|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->whereStatus(ApplicationStatus::Pending)->latest()->get();
	}

	public function getAllDocumentation():array|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->whereStatus(ApplicationStatus::Documentation)->latest()->get();
	}

	public function getAllAccepted():array|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->whereStatus(ApplicationStatus::Accepted)->latest()->get();
	}

	public function getAllRejected():array|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->whereStatus(ApplicationStatus::Rejected)->latest()->get();
	}

	public function getAllPaginated():array|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->latest()->paginate();
	}

	public function getAllPendingPaginated():array|LengthAwarePaginator|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->whereStatus(ApplicationStatus::Pending)->latest()->paginate();
	}

	public function getAllDocumentationPaginated():array|LengthAwarePaginator|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->whereStatus(ApplicationStatus::Documentation)->latest()->paginate();
	}

	public function getAllAcceptedPaginated():array|LengthAwarePaginator|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->whereStatus(ApplicationStatus::Accepted)->latest()->paginate();
	}

	public function getAllRejectedPaginated():array|LengthAwarePaginator|Collection{
		return Application::whereOfferType(ScholarshipOffer::class)->whereStatus(ApplicationStatus::Rejected)->paginate();
	}

}