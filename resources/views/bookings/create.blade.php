@extends('layouts.app')
@section('content')
    <h1>Confirm Booking</h1>
    @if(isset($branch))
        <div class="alert alert-info mb-3"><strong>Branch:</strong> {{ $branch->name }} ({{ $branch->address }})</div>
    @endif
    <form action="{{ route('bookings.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
        <input type="hidden" name="branch_id" value="{{ $branch->id ?? '' }}">
        <input type="hidden" name="table_id" value="{{ $table->id }}">
        <input type="hidden" name="date" value="{{ $date }}">
        <input type="hidden" name="time_slot" value="{{ $time_slot }}">
        <input type="hidden" name="seating_capacity" value="{{ $seating_capacity }}">
        <p>Restaurant: <strong>{{ $restaurant->name }}</strong></p>
        <p>Table: <strong>{{ $table->table_no }}</strong> (Seats: {{ $table->seating_capacity }})</p>
        <p>Date: <strong>{{ $date }}</strong></p>
        <p>Time Slot: <strong>{{ $time_slot }}</strong></p>
        <p>Seats Requested: <strong>{{ $seating_capacity }}</strong></p>
        <div class="mb-3">
            <label class="form-label">Group Size:</label>
            <input type="number" name="group_size" class="form-control" value="{{ old('group_size', $seating_capacity) }}" min="1">
            @error('group_size')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Event Type:</label>
            <select name="event_type" class="form-select">
                <option value="">Select Event</option>
                <option value="Birthday" @if(old('event_type')=='Birthday') selected @endif>Birthday</option>
                <option value="Corporate" @if(old('event_type')=='Corporate') selected @endif>Corporate</option>
                <option value="Anniversary" @if(old('event_type')=='Anniversary') selected @endif>Anniversary</option>
                <option value="Casual" @if(old('event_type')=='Casual') selected @endif>Casual</option>
                <option value="Other" @if(old('event_type')=='Other') selected @endif>Other</option>
            </select>
            @error('event_type')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Special Instructions:</label>
            <textarea name="special_instructions" class="form-control" rows="2">{{ old('special_instructions') }}</textarea>
            @error('special_instructions')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <button type="submit">Confirm Booking</button>
    </form>
    <a href="{{ route('bookings.index') }}">Cancel</a>
@endsection 