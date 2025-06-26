@extends('layouts.app')
@section('content')
    <h1>Edit Table for {{ $restaurant->name }}</h1>
    <form action="{{ route('tables.update', [$restaurant->id, $table->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Table No:</label>
            <input type="text" name="table_no" value="{{ old('table_no', $table->table_no) }}" required>
            @error('table_no')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <label>Seating Capacity:</label>
            <input type="number" name="seating_capacity" value="{{ old('seating_capacity', $table->seating_capacity) }}" required min="1">
            @error('seating_capacity')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <label>Layout Position:</label>
            <input type="text" name="layout_position" value="{{ old('layout_position', $table->layout_position) }}" required>
            @error('layout_position')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <label>Layout X:</label>
            <input type="number" name="layout_x" value="{{ old('layout_x', $table->layout_x) }}">
            @error('layout_x')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <label>Layout Y:</label>
            <input type="number" name="layout_y" value="{{ old('layout_y', $table->layout_y) }}">
            @error('layout_y')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="form-label">Branch:</label>
            <select name="branch_id" class="form-select" required>
                @foreach(App\Models\Branch::where('restaurant_id', $restaurant->id)->get() as $branch)
                    <option value="{{ $branch->id }}" @if($table->branch_id == $branch->id) selected @endif>{{ $branch->name }} ({{ $branch->address }})</option>
                @endforeach
            </select>
            @error('branch_id')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('tables.index', $restaurant->id) }}">Back to Tables</a>
@endsection 