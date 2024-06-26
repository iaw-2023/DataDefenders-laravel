@extends('layouts.app')

@section('title')
	Scholarship Applications
@endsection

@section('content')
	<x-header>
		<x-slot:title>Scholarship Applications</x-slot:title>
		<x-slot:description>Manage the pending scholarship offer applications.</x-slot:description>
		<x-slot:buttons></x-slot:buttons>
	</x-header>
	@include('layouts.messages')
	<div class="flex-grow overflow-y-auto flex flex-col">
		@include('layouts.pagination', ['paginated' => $applications])
		<div class="items">
			@foreach($applications as $application)
				@include('admin.applications.item')
			@endforeach
		</div>
		@include('layouts.pagination', ['paginated' => $applications])
	</div>
@endsection