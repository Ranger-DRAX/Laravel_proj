@extends('layouts.app')
@section('content')
    <h1>Add Restaurant</h1>
    <form action="{{ route('restaurants.store') }}" method="POST">
        @csrf
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <label>Description:</label>
            <textarea name="description">{{ old('description') }}</textarea>
            @error('description')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <label>Location:</label>
            <input type="text" name="location" value="{{ old('location') }}" required>
            @error('location')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <label>Contact Info:</label>
            <input type="text" name="contact_info" value="{{ old('contact_info') }}" required>
            @error('contact_info')<div>{{ $message }}</div>@enderror
        </div>
        <button type="submit">Add</button>
    </form>
    <a href="{{ route('restaurants.index') }}">Back to list</a>
@endsection 