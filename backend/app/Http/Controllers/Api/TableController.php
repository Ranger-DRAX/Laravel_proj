<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Models\Table;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List all tables with branch and bookings
        $tables = Table::with(['branch', 'bookings'])->paginate(10);
        return response()->json($tables);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableRequest $request)
    {
        $data = $request->validated();
        $table = Table::create($data);
        return response()->json($table, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $table = Table::with(['branch', 'bookings'])->findOrFail($id);
        return response()->json($table);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request, $id)
    {
        $table = Table::findOrFail($id);
        $this->authorize('update', $table);
        $table->update($request->validated());
        return response()->json($table);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $this->authorize('delete', $table);
        $table->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
