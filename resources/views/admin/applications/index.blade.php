@extends('layouts.app')

@section('title')
	All Applications
@endsection

@section('content')
	<x-header>
		<x-slot:title>All Applications</x-slot:title>
		<x-slot:description>Manage all the pending offer applications.</x-slot:description>
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