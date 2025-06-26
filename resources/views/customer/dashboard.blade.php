@extends('layouts.app')
@section('content')
    <h1>Customer Dashboard</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <h2>Upcoming Bookings</h2>
    @if($upcoming->isEmpty())
        <p>No upcoming bookings.</p>
    @else
        <ul>
            @foreach($upcoming as $booking)
                <li>
                    {{ $booking->date }} {{ $booking->time_slot }} - {{ $booking->restaurant->name }} (Table {{ $booking->table->table_no }}, Seats: {{ $booking->seating_capacity }})
                    [Status: {{ $booking->status }}]
                    @if($booking->status !== 'Cancelled')
                        <form action="{{ route('customer.cancel', $booking->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" onclick="return confirm('Cancel this booking?')">Cancel</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
    <h2>Booking History</h2>
    @if($history->isEmpty())
        <p>No past bookings.</p>
    @else
        <ul>
            @foreach($history as $booking)
                <li>
                    {{ $booking->date }} {{ $booking->time_slot }} - {{ $booking->restaurant->name }} (Table {{ $booking->table->table_no }}, Seats: {{ $booking->seating_capacity }})
                    [Status: {{ $booking->status }}]
                </li>
            @endforeach
        </ul>
    @endif
@endsection 