@extends('layouts.app')
@section('content')
    <h1>Admin Dashboard</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <h2>All Bookings</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Restaurant</th>
                <th>Table</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Seats</th>
                <th>Group Size</th>
                <th>Event Type</th>
                <th>Instructions</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                    <td>{{ $booking->restaurant->name ?? 'N/A' }}</td>
                    <td>{{ $booking->table->table_no ?? 'N/A' }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->time_slot }}</td>
                    <td>{{ $booking->seating_capacity }}</td>
                    <td>{{ $booking->group_size ?? '-' }}</td>
                    <td>{{ $booking->event_type ?? '-' }}</td>
                    <td>{{ $booking->special_instructions ?? '-' }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        @if($booking->status === 'Pending')
                            <form action="{{ route('admin.approve', $booking->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('PUT')
                                <button type="submit">Approve</button>
                            </form>
                            <form action="{{ route('admin.reject', $booking->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('PUT')
                                <button type="submit">Reject</button>
                            </form>
                        @endif
                        @if($booking->status !== 'Disputed')
                            <form action="{{ route('admin.dispute', $booking->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('PUT')
                                <button type="submit">Dispute</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 