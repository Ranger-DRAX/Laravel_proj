@extends('layouts.app')
@section('content')
    <h1>Added to Waitlist!</h1>
    <p>You have been added to the waitlist. We will notify you if a table becomes available.</p>
    <p>
        <strong>Restaurant:</strong> {{ $waitlist->restaurant->name }}<br>
        <strong>Date:</strong> {{ $waitlist->date }}<br>
        <strong>Time Slot:</strong> {{ $waitlist->time_slot }}<br>
        <strong>Seats:</strong> {{ $waitlist->seating_capacity }}<br>
        <strong>Status:</strong> {{ $waitlist->status }}
    </p>
    <a href="{{ route('bookings.index') }}">Back to Restaurants</a>
@endsection 