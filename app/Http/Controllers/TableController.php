<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Table;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $tables = $restaurant->tables;
        return view('tables.index', compact('restaurant', 'tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        return view('tables.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $validated = $request->validate([
            'table_no' => 'required|string|max:255',
            'seating_capacity' => 'required|integer|min:1',
            'layout_position' => 'required|string|max:255',
            'layout_x' => 'nullable|integer',
            'layout_y' => 'nullable|integer',
            'branch_id' => 'required|exists:branches,id',
        ]);
        $validated['restaurant_id'] = $restaurant->id;
        Table::create($validated);
        return redirect()->route('tables.index', $restaurant->id)->with('success', 'Table created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($restaurant_id, $id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $table = $restaurant->tables()->findOrFail($id);
        return view('tables.show', compact('restaurant', 'table'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($restaurant_id, $id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $table = $restaurant->tables()->findOrFail($id);
        return view('tables.edit', compact('restaurant', 'table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $restaurant_id, $id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $table = $restaurant->tables()->findOrFail($id);
        $validated = $request->validate([
            'table_no' => 'required|string|max:255',
            'seating_capacity' => 'required|integer|min:1',
            'layout_position' => 'required|string|max:255',
            'layout_x' => 'nullable|integer',
            'layout_y' => 'nullable|integer',
            'branch_id' => 'required|exists:branches,id',
        ]);
        $table->update($validated);
        return redirect()->route('tables.index', $restaurant->id)->with('success', 'Table updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($restaurant_id, $id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $table = $restaurant->tables()->findOrFail($id);
        $table->delete();
        return redirect()->route('tables.index', $restaurant->id)->with('success', 'Table deleted successfully.');
    }
}
