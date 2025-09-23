<?php

namespace App\Http\Controllers;

use App\Models\TaxGroup;
use Illuminate\Http\Request;

class TaxGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(TaxGroup::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description'   => 'required|string|max:255',
            'tax'           => 'boolean',
            'shipping_tax'  => 'numeric|min:0',
        ]);

        $taxGroup = TaxGroup::create($validated);

        return response()->json($taxGroup, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $taxGroup = TaxGroup::findOrFail($id);
        return response()->json($taxGroup);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $taxGroup = TaxGroup::findOrFail($id);

        $validated = $request->validate([
            'description'   => 'string|max:255',
            'tax'           => 'boolean',
            'shipping_tax'  => 'numeric|min:0',
        ]);

        $taxGroup->update($validated);

        return response()->json($taxGroup);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taxGroup = TaxGroup::findOrFail($id);
        $taxGroup->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
