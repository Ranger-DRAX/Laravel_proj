<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CustomerDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $today = date('Y-m-d');
        $upcoming = Booking::with(['restaurant', 'table'])
            ->where('user_id', $user->id)
            ->where('date', '>=', $today)
            ->where('status', '!=', 'Cancelled')
            ->orderBy('date')
            ->get();
        $history = Booking::with(['restaurant', 'table'])
            ->where('user_id', $user->id)
            ->where('date', '<', $today)
            ->orderByDesc('date')
            ->get();
        return view('customer.dashboard', compact('upcoming', 'history'));
    }

    // Cancel booking
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $booking->status = 'Cancelled';
        $booking->save();
        return redirect()->route('customer.dashboard')->with('success', 'Booking cancelled.');
    }
}
