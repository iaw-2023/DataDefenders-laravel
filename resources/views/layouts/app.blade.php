<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title') | {{ config('app.name') }}</title>

		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body class="antialiased">
		<div class="relative flex h-screen bg-dots-darker bg-center bg-gray-50">
			<aside class="h-screen min-w-fit p-6 bg-sky-900 flex flex-col gap-6">
				<a href="{{ route('home') }}">
					<img src="{{ Storage::url('logos/unimanager.svg') }}" class="w-48" alt="{{ config('app.name') }} logo">
				</a>
				<nav class="nav">
					<a href="{{ route('home') }}" class="nav-item @if(Route::currentRouteNamed('home')) nav-item-active @endif">
						<i class="fa-solid fa-home"></i>
						Home
					</a>
					{{--@auth--}}
						<a href="{{ route('departments.index') }}" class="nav-item @if(Route::currentRouteNamed('departments.*')) nav-item-active @endif">
							<i class="fa-solid fa-university"></i>
							Departments
						</a>
						<a href="{{ route('majors.index') }}" class="nav-item @if(Route::currentRouteNamed('majors.*')) nav-item-active @endif">
							<i class="fa-solid fa-scroll"></i>
							Majors
						</a>
						<p class="nav-p">Offers</p>
						<a href="{{ route('offers.job.index') }}" class="nav-item @if(Route::currentRouteNamed('offers.job.*')) nav-item-active @endif">
							<i class="fa-solid fa-briefcase"></i>
							Jobs
						</a>
						<a href="{{ route('offers.scholarship.index') }}" class="nav-item @if(Route::currentRouteNamed('offers.scholarship.*')) nav-item-active @endif">
							<i class="fa-solid fa-graduation-cap"></i>
							Scholarships
						</a>
					{{--@else
						<a href="{{ route('login') }}" class="nav-item @if(Route::currentRouteNamed('login')) nav-item-active @endif">
							<i class="fa-solid fa-key"></i>
							Login
						</a>
					@endauth--}}
				</nav>
			</aside>
			<div class="flex-grow h-screen flex flex-col">
				@yield('content')
			</div>
		</div>
	</body>
</html>
