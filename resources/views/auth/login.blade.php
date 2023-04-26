@extends('layouts.app')

@section('title')
	Log in
@endsection

@section('content')
<form action="{{ route('login') }}" method="post" class="h-screen flex flex-col">
		@csrf
		<x-header>
		<x-slot:title>
				Log in
			</x-slot:title>
			<x-slot:description></x-slot:description>
			<x-slot:buttons></x-slot:buttons>
		</x-header>
		<div class="flex-grow overflow-y-auto flex flex-col gap-6 p-6">
			@if(session('error'))
				<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
			@endif
			@if(session('success'))
				<div class="px-3 py-2 bg-green-700 text-white rounded">{{ session('success') }}</div>
			@endif
			<div class="labeled-input">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" value="{{ old('email') }}">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" value="{{ old('password') }}">
			</div>
			<a href="{{ route('accountrecovery') }}" class="text-m font-bold text-sky-700 flex items-center gap-3">
							Forgot password?
						</a>
			<button type="submit" class="btn bg-sky-700 text-white w-max">
					Log in
			</button>
		</div>
	</form>
@endsection