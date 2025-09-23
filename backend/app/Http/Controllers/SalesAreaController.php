<?php

namespace App\Http\Controllers;

use App\Models\SalesArea;
use Illuminate\Http\Request;

class SalesAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesAreas = SalesArea::all();
        return response()->json($salesAreas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $salesArea = SalesArea::create($validatedData);

        return response()->json($salesArea, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salesArea = SalesArea::find($id);

        if (!$salesArea) {
            return response()->json(['message' => 'Sales area not found'], 404);
        }

        return response()->json($salesArea);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $salesArea = SalesArea::find($id);

        if (!$salesArea) {
            return response()->json(['message' => 'Sales area not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ]
        ]);

        $salesArea->update($validatedData);

        return response()->json($salesArea);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salesArea = SalesArea::find($id);

        if (!$salesArea) {
            return response()->json(['message' => 'Sales area not found'], 404);
        }

        $salesArea->delete();

        return response()->json(['message' => 'Sales area deleted successfully']);
    }
}
