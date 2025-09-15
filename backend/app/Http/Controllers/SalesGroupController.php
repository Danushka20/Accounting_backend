<?php

namespace App\Http\Controllers;

use App\Models\SalesGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalesGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesGroups = SalesGroup::all();
        return response()->json($salesGroups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:sales_groups,name'
        ]);

        $salesGroup = SalesGroup::create($validatedData);

        return response()->json($salesGroup, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salesGroup = SalesGroup::find($id);

        if (!$salesGroup) {
            return response()->json(['message' => 'Sales group not found'], 404);
        }

        return response()->json($salesGroup);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $salesGroup = SalesGroup::find($id);

        if (!$salesGroup) {
            return response()->json(['message' => 'Sales group not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sales_groups')->ignore($salesGroup->id)
            ]
        ]);

        $salesGroup->update($validatedData);

        return response()->json($salesGroup);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salesGroup = SalesGroup::find($id);

        if (!$salesGroup) {
            return response()->json(['message' => 'Sales group not found'], 404);
        }

        $salesGroup->delete();

        return response()->json(['message' => 'Sales group deleted successfully']);
    }
}
