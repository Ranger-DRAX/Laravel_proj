@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-primary">Branches</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('branches.create') }}" class="btn btn-success mb-3">Add Branch</a>
    <table class="table table-striped table-bordered bg-white shadow">
        <thead class="table-primary">
            <tr>
                <th>Restaurant</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Info</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($branches as $branch)
                <tr>
                    <td>{{ $branch->restaurant->name }}</td>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->address }}</td>
                    <td>{{ $branch->contact_info }}</td>
                    <td>
                        <a href="{{ route('branches.edit', $branch) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('branches.destroy', $branch) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this branch?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 