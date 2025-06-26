@extends('layouts.app')
@section('content')
    <h1>Booking Confirmed!</h1>
    <p>Your booking has been submitted and a confirmation email has been sent.</p>
    <p>
        <strong>Restaurant:</strong> {{ $booking->restaurant->name }}<br>
        @if($booking->branch)
            <strong>Branch:</strong> {{ $booking->branch->name }} ({{ $booking->branch->address }})<br>
        @endif
        <strong>Table:</strong> {{ $booking->table->table_no }}<br>
        <strong>Date:</strong> {{ $booking->date }}<br>
        <strong>Time Slot:</strong> {{ $booking->time_slot }}<br>
        <strong>Seats:</strong> {{ $booking->seating_capacity }}<br>
        @if($booking->group_size)
            <strong>Group Size:</strong> {{ $booking->group_size }}<br>
        @endif
        @if($booking->event_type)
            <strong>Event Type:</strong> {{ $booking->event_type }}<br>
        @endif
        @if($booking->special_instructions)
            <strong>Special Instructions:</strong> {{ $booking->special_instructions }}<br>
        @endif
        <strong>Status:</strong> {{ $booking->status }}
    </p>
    <a href="{{ route('bookings.index') }}">Back to Restaurants</a>
@endsection 