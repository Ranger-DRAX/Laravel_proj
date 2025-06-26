@extends('layouts.app')
@section('content')
    <h1>{{ $restaurant->name }}</h1>
    <p><strong>Description:</strong> {{ $restaurant->description }}</p>
    <p><strong>Location:</strong> {{ $restaurant->location }}</p>
    <p><strong>Contact Info:</strong> {{ $restaurant->contact_info }}</p>
    <a href="{{ route('restaurants.edit', $restaurant) }}">Edit</a> |
    <a href="{{ route('restaurants.index') }}">Back to list</a>
@endsection 