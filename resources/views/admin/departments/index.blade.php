@extends('layouts.app')

@section('title')
	Departments
@endsection

@section('content')
	<x-header>
		<x-slot:title>Departments</x-slot:title>
		<x-slot:description>Manage the departments that may offer jobs.</x-slot:description>
		<x-slot:buttons>
			<a href="{{ route('departments.create') }}" class="btn bg-sky-700 text-white">
				<i class="fa-solid fa-plus"></i> Add new </a>
		</x-slot:buttons>
	</x-header>
	@if(session('success'))
		<div class="alert bg-green-700 text-white">{{ session('success') }}</div>
	@endif
	@if(session('error'))
		<div class="alert bg-red-700 text-white">{{ session('error') }}</div>
	@endif
	<div class="flex-grow overflow-y-auto flex flex-col">
		<div class="items">
			@foreach($departments as $department)
				<a class="item flex items-center gap-2" href="{{ route('departments.edit', $department) }}">
					<i class="fa-solid fa-university text-gray-400"></i>
					<p class="flex-grow">{{ $department->name }}</p>
					<i class="fa-solid fa-chevron-right text-gray-400"></i> </a>
			@endforeach
		</div>
	</div>
@endsection