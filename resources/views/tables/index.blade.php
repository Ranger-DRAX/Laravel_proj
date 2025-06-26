@extends('layouts.app')
@section('content')
<style>
.table-grid-container {
    position: relative;
    width: 400px;
    height: 400px;
    border: 1px solid #ccc;
    margin-bottom: 2em;
    background: #f9f9f9;
}
.table-grid-box {
    position: absolute;
    width: 36px;
    height: 36px;
    background: #4caf50;
    color: #fff;
    text-align: center;
    line-height: 36px;
    border-radius: 8px;
    box-shadow: 1px 1px 4px #aaa;
    font-weight: bold;
}
</style>
<div class="container py-4">
    <h1 class="mb-4 text-primary">Tables for {{ $restaurant->name }}</h1>
    <a href="{{ route('tables.create', $restaurant->id) }}" class="btn btn-success mb-3">Add Table</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped table-bordered bg-white shadow">
        <thead class="table-primary">
            <tr>
                <th>Table No</th>
                <th>Seating Capacity</th>
                <th>Layout Position</th>
                <th>Branch</th>
                <th>X</th>
                <th>Y</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tables as $table)
                <tr>
                    <td>{{ $table->table_no }}</td>
                    <td>{{ $table->seating_capacity }}</td>
                    <td>{{ $table->layout_position }}</td>
                    <td>{{ $table->branch->name ?? '-' }}</td>
                    <td>{{ $table->layout_x ?? '-' }}</td>
                    <td>{{ $table->layout_y ?? '-' }}</td>
                    <td>
                        <a href="{{ route('tables.show', [$restaurant->id, $table->id]) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('tables.edit', [$restaurant->id, $table->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tables.destroy', [$restaurant->id, $table->id]) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this table?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2 class="mt-5 mb-3 text-success">Table Layout (Grid View)</h2>
    <div class="table-grid-container">
        @foreach($tables as $table)
            @if($table->layout_x !== null && $table->layout_y !== null)
                <div class="table-grid-box" style="left:{{ $table->layout_x * 40 }}px;top:{{ $table->layout_y * 40 }}px;">
                    {{ $table->table_no }}
                </div>
            @endif
        @endforeach
    </div>
    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Back to Restaurants</a>
</div>
@endsection 