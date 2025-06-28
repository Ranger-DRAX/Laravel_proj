<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List all restaurants with branches
        $restaurants = Restaurant::with('branches')->paginate(10);
        return response()->json($restaurants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        $data = $request->validated();
        $data['owner_id'] = Auth::id();
        $restaurant = Restaurant::create($data);
        return response()->json($restaurant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurant = Restaurant::with('branches')->findOrFail($id);
        return response()->json($restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $this->authorize('update', $restaurant);
        $restaurant->update($request->validated());
        return response()->json($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $this->authorize('delete', $restaurant);
        $restaurant->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
