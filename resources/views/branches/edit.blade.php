@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-warning">Edit Branch</h1>
    <form action="{{ route('branches.update', $branch) }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Restaurant:</label>
            <select name="restaurant_id" class="form-select" required>
                @foreach($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}" @if($branch->restaurant_id == $restaurant->id) selected @endif>{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Branch Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $branch->name) }}" required>
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Address:</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $branch->address) }}" required>
            @error('address')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Contact Info:</label>
            <input type="text" name="contact_info" class="form-control" value="{{ old('contact_info', $branch->contact_info) }}" required>
            @error('contact_info')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-warning">Update Branch</button>
        <a href="{{ route('branches.index') }}" class="btn btn-secondary">Back to list</a>
    </form>
</div>
@endsection 