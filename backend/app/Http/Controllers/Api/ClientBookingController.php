<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientBooking;
use Illuminate\Support\Facades\Auth;

class ClientBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = ClientBooking::query();
        if ($request->filled('restaurant')) {
            $query->where('restaurant', $request->get('restaurant'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        } else {
            $query->whereIn('status', ['pending', 'paid']);
        }
        // return minimal data
        return response()->json($query->get(['seat_code']));
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant' => 'required|string',
            'area'       => 'required|string',
            'seat_code'  => 'required|string',
            'amount'     => 'required|integer|min:1',
            'persons'    => 'required|integer|min:1|max:12',
            'table_type' => 'required|string|in:duo,family,big',
        ]);
        if($request->wantsJson()===false){$validated = $request->all();}
        $validated['user_id'] = Auth::id();
        $booking = ClientBooking::create($validated);
        return response()->json(['id' => $booking->id], 201);
    }

    public function show($id)
    {
        $booking = ClientBooking::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($booking);
    }

    public function update(Request $request,$id)
    {
        $booking=ClientBooking::where('user_id',Auth::id())->findOrFail($id);
        $data=$request->validate([
            'foods'=>'nullable|string', // json encoded
            'amount'=>'nullable|integer|min:1'
        ]);
        $booking->update($data);
        return response()->json($booking);
    }

    public function pay($id)
    {
        $booking = ClientBooking::where('user_id', Auth::id())->findOrFail($id);
        $booking->update(['status' => 'paid']);
        return response()->json(['message' => 'Payment recorded']);
    }
}
