@extends('layouts.app')
@section('content')
    <h1>Restaurants</h1>
    <a href="{{ route('restaurants.create') }}">Add Restaurant</a>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Contact Info</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($restaurants as $restaurant)
                <tr>
                    <td>{{ $restaurant->name }}</td>
                    <td>{{ $restaurant->description }}</td>
                    <td>{{ $restaurant->location }}</td>
                    <td>{{ $restaurant->contact_info }}</td>
                    <td>
                        <a href="{{ route('restaurants.show', $restaurant) }}">View</a> |
                        <a href="{{ route('restaurants.edit', $restaurant) }}">Edit</a> |
                        <form action="{{ route('restaurants.destroy', $restaurant) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this restaurant?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 