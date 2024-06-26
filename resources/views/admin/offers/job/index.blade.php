@extends('layouts.app')

@section('title')
	Job Offers
@endsection

@section('content')
	<x-header>
		<x-slot:title>Job Offers</x-slot:title>
		<x-slot:description>Manage the job offers that people may apply to.</x-slot:description>
		<x-slot:buttons>
			@can('create.offers')
				<a href="{{ route('offers.job.create') }}" class="btn btn-primary">
					<i class="fa-solid fa-plus"></i>
					Add new
				</a>
			@endcan
		</x-slot:buttons>
	</x-header>
	@include('layouts.messages')
	<div class="flex-grow overflow-y-auto flex flex-col">
		@include('layouts.pagination', ['paginated' => $offers])
		<div class="items">
			@foreach($offers as $offer)
				<a class="item flex items-center gap-2" href="{{ route('offers.job.edit', $offer) }}">
					<div class="flex-grow">
						<p class="font-medium text-lg">{{ $offer->title }}</p>
						<p class="text-sm text-gray-400 flex items-center gap-2">
							<i class="fa-solid fa-briefcase text-gray-400"></i>
							{{ $offer->department->name }}
						</p>
					</div>
					@include('admin.offers.hidden')
					@include('admin.offers.applicants')
					<i class="fa-solid fa-chevron-right text-gray-400"></i>
				</a>
			@endforeach
		</div>
		@include('layouts.pagination', ['paginated' => $offers])
	</div>
@endsection