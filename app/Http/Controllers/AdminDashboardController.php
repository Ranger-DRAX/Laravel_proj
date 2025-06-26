<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $bookings = Booking::with(['user', 'restaurant', 'table'])->orderByDesc('date')->get();
        return view('admin.dashboard', compact('bookings'));
    }

    // Approve booking
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Approved';
        $booking->save();
        return redirect()->route('admin.dashboard')->with('success', 'Booking approved.');
    }

    // Reject booking
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Rejected';
        $booking->save();
        return redirect()->route('admin.dashboard')->with('success', 'Booking rejected.');
    }

    // Mark as disputed
    public function dispute($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Disputed';
        $booking->save();
        return redirect()->route('admin.dashboard')->with('success', 'Booking marked as disputed.');
    }

    public function analytics()
    {
        $totalBookings = \App\Models\Booking::count();
        $today = date('Y-m-d');
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();
        $bookingsToday = \App\Models\Booking::where('date', $today)->count();
        $bookingsThisWeek = \App\Models\Booking::where('date', '>=', $thisWeek)->count();
        $bookingsThisMonth = \App\Models\Booking::where('date', '>=', $thisMonth)->count();
        $peakHours = \App\Models\Booking::select('time_slot', DB::raw('count(*) as count'))
            ->groupBy('time_slot')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
        return view('admin.analytics', compact('totalBookings', 'bookingsToday', 'bookingsThisWeek', 'bookingsThisMonth', 'peakHours'));
    }
}
