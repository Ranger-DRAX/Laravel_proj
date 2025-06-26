@extends('layouts.app')
@section('content')
    <h1>Select a Restaurant</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <ul>
        @foreach($restaurants as $restaurant)
            <li class="mb-4 p-3 bg-white shadow rounded">
                <form action="{{ route('bookings.availableTables', $restaurant->id) }}" method="GET" class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <strong class="text-primary">{{ $restaurant->name }}</strong> <span class="text-muted">({{ $restaurant->location }})</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Branch:</label>
                        <select name="branch_id" class="form-select" required>
                            <option value="">Select Branch</option>
                            @foreach(App\Models\Branch::where('restaurant_id', $restaurant->id)->get() as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }} ({{ $branch->address }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Date:</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Time Slot:</label>
                        <select name="time_slot" class="form-select">
                            <option value="18:00-19:00">18:00-19:00</option>
                            <option value="19:00-20:00">19:00-20:00</option>
                            <option value="20:00-21:00">20:00-21:00</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Seats:</label>
                        <input type="number" name="seating_capacity" class="form-control" value="2" min="1" required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Check Availability</button>
                    </div>
                </form>
            </li>
        @endforeach
    </ul>
    <p style="margin-top:2em;">(For demo: defaults to 2 seats, today, 18:00-19:00. You can add a form for custom input.)</p>
@endsection 