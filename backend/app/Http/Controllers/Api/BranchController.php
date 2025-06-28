<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List all branches with restaurant and tables
        $branches = Branch::with(['restaurant', 'tables'])->paginate(10);
        return response()->json($branches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        $data = $request->validated();
        $branch = Branch::create($data);
        return response()->json($branch, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $branch = Branch::with(['restaurant', 'tables'])->findOrFail($id);
        return response()->json($branch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $this->authorize('update', $branch);
        $branch->update($request->validated());
        return response()->json($branch);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $this->authorize('delete', $branch);
        $branch->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
