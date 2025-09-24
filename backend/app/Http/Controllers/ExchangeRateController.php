<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExchangeRate;

class ExchangeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ExchangeRate::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'curr_code' => 'required|string|size:3',
            'rate_buy' => 'required|numeric',
            'rate_sell' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $rate = ExchangeRate::create($validated);
        return response()->json($rate, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rate = ExchangeRate::find($id);
        if (!$rate) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($rate, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rate = ExchangeRate::find($id);
        if (!$rate) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $validated = $request->validate([
            'curr_code' => 'string|size:3',
            'rate_buy' => 'numeric',
            'rate_sell' => 'numeric',
            'date' => 'date',
        ]);

        $rate->update($validated);
        return response()->json($rate, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rate = ExchangeRate::find($id);
        if (!$rate) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $rate->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
