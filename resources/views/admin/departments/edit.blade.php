@extends('layouts.app')

@section('title')
	Edit Department: {{ $department->name }}
@endsection

@section('content')
	<form action="{{ route('departments.update', $department) }}" method="post" class="h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('departments.index') }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				{{ $department->name }}
			</x-slot:title>
			<x-slot:description>
				<span class="icon-text">
					<i class="fa-solid fa-university"></i>
					Department
				</span>
			</x-slot:description>
			<x-slot:buttons>
				<div class="flex items-center gap-3">
					<a href="{{ route('departments.delete_confirm', $department) }}" class="btn-outline border-gray-300 text-gray-600 hover:bg-red-50 hover:border-red-200 hover:text-red-400">
						<i class="fa-solid fa-trash"></i>
						Delete
					</a>
					<button type="submit" class="btn bg-sky-700 text-white">
						<i class="fa-solid fa-check"></i>
						Save changes
					</button>
				</div>
			</x-slot:buttons>
		</x-header>
		<div class="flex-grow overflow-y-auto flex flex-col gap-6 p-6">
			@if(session('error'))
				<div class="alert bg-red-700 text-white">
					<i class="fa-solid fa-triangle-exclamation"></i>
					{{ session('error') }}
				</div>
			@endif
			<div class="labeled-input">
				<label for="name">Name</label>
				<input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $department->name }}">
			</div>
		</div>
	</form>
@endsection