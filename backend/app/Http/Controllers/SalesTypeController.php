<?php

namespace App\Http\Controllers;

use App\Models\SalesType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesTypes = SalesType::all();
        return response()->json($salesTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_name' => 'required|string|max:255|unique:sales_types,type_name',
            'factor' => 'required|numeric',
            'tax_incl' => 'required|boolean',
            'status' => 'required|in:Active,Inactive'
        ]);

        $salesType = SalesType::create($validatedData);

        return response()->json($salesType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salesType = SalesType::find($id);

        if (!$salesType) {
            return response()->json(['message' => 'Sales type not found'], 404);
        }

        return response()->json($salesType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $salesType = SalesType::find($id);

        if (!$salesType) {
            return response()->json(['message' => 'Sales type not found'], 404);
        }

        $validatedData = $request->validate([
            'type_name' => [
                'required',
                'string',
                'max:255',
            ],
            'factor' => 'required|numeric',
            'tax_incl' => 'required|boolean',
            'status' => 'required|in:Active,Inactive'
        ]);

        $salesType->update($validatedData);

        return response()->json($salesType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salesType = SalesType::find($id);

        if (!$salesType) {
            return response()->json(['message' => 'Sales type not found'], 404);
        }

        $salesType->delete();

        return response()->json(['message' => 'Sales type deleted successfully']);
    }
}