@if(isset($branch))
    <div class="alert alert-info mb-2"><strong>Branch:</strong> {{ $branch->name }} ({{ $branch->address }})</div>
@endif
@if($tables->isEmpty())
    <p>No tables available for this slot.</p>
    <form action="{{ route('waitlist.store') }}" method="POST" class="mt-2">
        @csrf
        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
        <input type="hidden" name="branch_id" value="{{ $branch->id ?? '' }}">
        <input type="hidden" name="date" value="{{ $date }}">
        <input type="hidden" name="time_slot" value="{{ $time_slot }}">
        <input type="hidden" name="seating_capacity" value="{{ $seating_capacity }}">
        <button type="submit" class="btn btn-warning">Join Waitlist</button>
    </form>
@else
    <ul class="list-group mb-3">
        @foreach($tables as $table)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <strong class="text-success">Table {{ $table->table_no }}</strong> (Seats: {{ $table->seating_capacity }}, Position: {{ $table->layout_position }})
                </span>
                <form action="{{ route('bookings.create') }}" method="GET" style="display:inline">
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    <input type="hidden" name="branch_id" value="{{ $branch->id ?? '' }}">
                    <input type="hidden" name="table_id" value="{{ $table->id }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="time_slot" value="{{ $time_slot }}">
                    <input type="hidden" name="seating_capacity" value="{{ $seating_capacity }}">
                    <button type="submit" class="btn btn-primary">Book</button>
                </form>
            </li>
        @endforeach
    </ul>
@endif 