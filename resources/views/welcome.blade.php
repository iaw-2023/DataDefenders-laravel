@extends('layouts.app')

@section('title')
	Home
@endsection

@section('content')
	<x-header>
		<x-slot:title>Home</x-slot:title>
		<x-slot:description>Find quick links and overall information.</x-slot:description>
		<x-slot:buttons></x-slot:buttons>
	</x-header>
@endsection