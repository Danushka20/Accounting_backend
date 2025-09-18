<?php

namespace App\Http\Controllers;

use App\Models\TaxType;
use Illuminate\Http\Request;

class TaxTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(TaxType::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string|max:255',
            'default_rate' => 'required|numeric|min:0',
            'sales_gl_account' => 'required|string|max:255',
            'purchasing_gl_account' => 'required|string|max:255',
        ]);

        $taxType = TaxType::create($data);

        return response()->json($taxType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $taxType = TaxType::find($id);

        if (!$taxType) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($taxType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $taxType = TaxType::find($id);

        if (!$taxType) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $data = $request->validate([
            'description' => 'string|max:255',
            'default_rate' => 'numeric|min:0',
            'sales_gl_account' => 'string|max:255',
            'purchasing_gl_account' => 'string|max:255',
        ]);

        $taxType->update($data);

        return response()->json($taxType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taxType = TaxType::find($id);

        if (!$taxType) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $taxType->delete();

        return response()->json(['message' => 'Deleted Successfully']);
    }
}
