<h2>Booking Confirmation</h2>
<p>Thank you for your booking!</p>
<p>
    <strong>Restaurant:</strong> {{ $booking->restaurant->name }}<br>
    <strong>Table:</strong> {{ $booking->table->table_no }}<br>
    <strong>Date:</strong> {{ $booking->date }}<br>
    <strong>Time Slot:</strong> {{ $booking->time_slot }}<br>
    <strong>Seats:</strong> {{ $booking->seating_capacity }}<br>
    <strong>Status:</strong> {{ $booking->status }}
</p> 