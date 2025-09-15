<?php

namespace App\Http\Controllers;

use App\Models\FiscalYear;
use Illuminate\Http\Request;

class FiscalYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fiscalYears = FiscalYear::select([
            'id',
            'fiscal_year_from',
            'fiscal_year_to',
        ])->get();

        return response()->json($fiscalYears);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fiscal_year_from' => 'required|string|max:255|unique:fiscal_years,fiscal_year_from',
            'fiscal_year_to' => 'required|string|max:255',
        ]);

        $fiscalYear = FiscalYear::create($validatedData);

        return response()->json($fiscalYear, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fiscalYear = FiscalYear::find($id);

        if (!$fiscalYear) {
            return response()->json(['message' => 'Fiscal year not found'], 404);
        }

        return response()->json($fiscalYear);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fiscalYear = FiscalYear::find($id);

        if (!$fiscalYear) {
            return response()->json(['message' => 'Fiscal year not found'], 404);
        }

        $validatedData = $request->validate([
            'fiscal_year_from' => 'required|string|max:255|unique:fiscal_years,fiscal_year_from,' . $id,
            'fiscal_year_to' => 'required|string|max:255',
        ]);

        $fiscalYear->update($validatedData);

        return response()->json($fiscalYear);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fiscalYear = FiscalYear::find($id);

        if (!$fiscalYear) {
            return response()->json(['message' => 'Fiscal year not found'], 404);
        }

        $fiscalYear->delete();

        return response()->json(['message' => 'Fiscal year deleted']);
    }
}
