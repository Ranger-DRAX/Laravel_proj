<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('bookings.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $restaurant = Restaurant::findOrFail($request->input('restaurant_id'));
        $branch = \App\Models\Branch::findOrFail($request->input('branch_id'));
        $table = \App\Models\Table::findOrFail($request->input('table_id'));
        $date = $request->input('date');
        $time_slot = $request->input('time_slot');
        $seating_capacity = $request->input('seating_capacity');
        return view('bookings.create', compact('restaurant', 'branch', 'table', 'date', 'time_slot', 'seating_capacity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'branch_id' => 'required|exists:branches,id',
            'table_id' => 'required|exists:tables,id',
            'date' => 'required|date',
            'time_slot' => 'required|string',
            'seating_capacity' => 'required|integer|min:1',
            'group_size' => 'nullable|integer|min:1',
            'event_type' => 'nullable|string|max:255',
            'special_instructions' => 'nullable|string',
        ]);
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'Pending';
        $booking = Booking::create($validated);
        // Send confirmation email
        Mail::to(Auth::user()->email)->send(new BookingConfirmation($booking->fresh(['restaurant', 'table'])));
        return redirect()->route('bookings.confirmation', $booking->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Show available tables for a restaurant, date, time slot, and seating capacity
    public function showAvailableTables(Request $request, $restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $branch_id = $request->input('branch_id');
        $date = $request->input('date');
        $time_slot = $request->input('time_slot');
        $seating_capacity = $request->input('seating_capacity');
        $branch = $branch_id ? \App\Models\Branch::find($branch_id) : null;

        $tables = $restaurant->tables()
            ->where('branch_id', $branch_id)
            ->where('seating_capacity', '>=', $seating_capacity)
            ->get()
            ->filter(function ($table) use ($date, $time_slot) {
                return !Booking::where('table_id', $table->id)
                    ->where('date', $date)
                    ->where('time_slot', $time_slot)
                    ->exists();
            });

        return view('bookings.available_tables', compact('restaurant', 'branch', 'tables', 'date', 'time_slot', 'seating_capacity'));
    }

    // Show confirmation page
    public function confirmation($id)
    {
        $booking = Booking::with(['restaurant', 'table'])->findOrFail($id);
        return view('bookings.confirmation', compact('booking'));
    }

    // API endpoint for AJAX real-time table availability
    public function apiAvailableTables(Request $request, $restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $date = $request->input('date');
        $time_slot = $request->input('time_slot');
        $seating_capacity = $request->input('seating_capacity');

        $tables = $restaurant->tables()
            ->where('seating_capacity', '>=', $seating_capacity)
            ->get()
            ->filter(function ($table) use ($date, $time_slot) {
                return !Booking::where('table_id', $table->id)
                    ->where('date', $date)
                    ->where('time_slot', $time_slot)
                    ->exists();
            })
            ->values();

        return response()->json($tables);
    }
}
