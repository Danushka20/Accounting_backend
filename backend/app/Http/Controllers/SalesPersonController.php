<?php

namespace App\Http\Controllers;

use App\Models\SalesPerson;
use Illuminate\Http\Request;

class SalesPersonController extends Controller
{
    // Get all sales people
    public function index()
    {
        return response()->json(SalesPerson::all(), 200);
    }

    // Store new sales person
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'fax' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'provision' => 'nullable|numeric',
            'turnover_break_point' => 'nullable|numeric',
            'provision2' => 'nullable|numeric',
        ]);

        $salesPerson = SalesPerson::create($validated);

        return response()->json($salesPerson, 201);
    }

    // Show single sales person
    public function show($id)
    {
        $salesPerson = SalesPerson::findOrFail($id);
        return response()->json($salesPerson, 200);
    }

    // Update sales person
    public function update(Request $request, $id)
    {
        $salesPerson = SalesPerson::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'fax' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'provision' => 'nullable|numeric',
            'turnover_break_point' => 'nullable|numeric',
            'provision2' => 'nullable|numeric',
        ]);

        $salesPerson->update($validated);

        return response()->json($salesPerson, 200);
    }

    // Delete sales person
    public function destroy($id)
    {
        $salesPerson = SalesPerson::findOrFail($id);
        $salesPerson->delete();

        return response()->json(['message' => 'Sales person deleted successfully'], 200);
    }
}
