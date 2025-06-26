@extends('layouts.app')
@section('content')
    <h1>Available Tables for {{ $restaurant->name }}</h1>
    @if(isset($branch))
        <div class="alert alert-info mb-3"><strong>Branch:</strong> {{ $branch->name }} ({{ $branch->address }})</div>
    @endif
    <form id="availability-form" class="row g-2 align-items-end mb-4">
        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
        <input type="hidden" name="branch_id" value="{{ $branch->id ?? request('branch_id') }}">
        <label>Date: <input type="date" name="date" value="{{ $date }}" required></label>
        <label>Time Slot:
            <select name="time_slot">
                <option value="18:00-19:00" @if($time_slot=="18:00-19:00") selected @endif>18:00-19:00</option>
                <option value="19:00-20:00" @if($time_slot=="19:00-20:00") selected @endif>19:00-20:00</option>
                <option value="20:00-21:00" @if($time_slot=="20:00-21:00") selected @endif>20:00-21:00</option>
            </select>
        </label>
        <label>Seats: <input type="number" name="seating_capacity" value="{{ $seating_capacity }}" min="1" required></label>
        <button type="submit">Check Availability</button>
    </form>
    <div id="tables-list">
        @include('bookings.partials.tables_list', ['tables' => $tables, 'restaurant' => $restaurant, 'branch' => $branch, 'date' => $date, 'time_slot' => $time_slot, 'seating_capacity' => $seating_capacity])
    </div>
    <a href="{{ route('bookings.index') }}">Back to Restaurants</a>
    <script>
        document.getElementById('availability-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const date = form.date.value;
            const time_slot = form.time_slot.value;
            const seating_capacity = form.seating_capacity.value;
            fetch(`{{ route('bookings.apiAvailableTables', $restaurant->id) }}?date=${date}&time_slot=${time_slot}&seating_capacity=${seating_capacity}`)
                .then(res => res.json())
                .then(tables => {
                    let html = '';
                    if (tables.length === 0) {
                        html = '<p>No tables available for this slot.</p>';
                    } else {
                        html = '<ul>';
                        tables.forEach(table => {
                            html += `<li>Table ${table.table_no} (Seats: ${table.seating_capacity}, Position: ${table.layout_position})
                                <form action=\"{{ route('bookings.create') }}\" method=\"GET\" style=\"display:inline\">
                                    <input type=\"hidden\" name=\"restaurant_id\" value=\"${table.restaurant_id}\">
                                    <input type=\"hidden\" name=\"table_id\" value=\"${table.id}\">
                                    <input type=\"hidden\" name=\"date\" value=\"${date}\">
                                    <input type=\"hidden\" name=\"time_slot\" value=\"${time_slot}\">
                                    <input type=\"hidden\" name=\"seating_capacity\" value=\"${seating_capacity}\">
                                    <button type=\"submit\">Book</button>
                                </form></li>`;
                        });
                        html += '</ul>';
                    }
                    document.getElementById('tables-list').innerHTML = html;
                });
        });
    </script>
@endsection 