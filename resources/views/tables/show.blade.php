@extends('layouts.app')
@section('content')
    <h1>Table {{ $table->table_no }} for {{ $restaurant->name }}</h1>
    <p><strong>Seating Capacity:</strong> {{ $table->seating_capacity }}</p>
    <p><strong>Layout Position:</strong> {{ $table->layout_position }}</p>
    <a href="{{ route('tables.edit', [$restaurant->id, $table->id]) }}">Edit</a> |
    <a href="{{ route('tables.index', $restaurant->id) }}">Back to Tables</a>
@endsection 