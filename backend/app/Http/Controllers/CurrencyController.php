<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::select([
            'id',
            'currency_abbreviation',
            'currency_symbol',
            'currency_name',
            'hundredths_name',
            'country',
            'auto_exchange_rate_update'
        ])->get();

        return response()->json($currencies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'currency_abbreviation' => 'required|string|max:10|unique:currencies,currency_abbreviation',
            'currency_symbol' => 'required|string|max:10',
            'currency_name' => 'required|string|max:255',
            'hundredths_name' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'auto_exchange_rate_update' => 'sometimes|boolean'
        ]);

        $currency = Currency::create([
            "currency_abbreviation" => $validatedData['currency_abbreviation'],
            "currency_symbol" => $validatedData['currency_symbol'],
            "currency_name" => $validatedData['currency_name'],
            "hundredths_name" => $validatedData['hundredths_name'] ?? null,
            "country" => $validatedData['country'],
            "auto_exchange_rate_update" => $validatedData['auto_exchange_rate_update'] ?? false,
        ]);

        return response()->json($currency, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currency = Currency::find($id);

        if (!$currency) {
            return response()->json(['message' => 'Currency not found'], 404);
        }

        return response()->json($currency);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $currency = Currency::find($id);

        if (!$currency) {
            return response()->json(['message' => 'Currency not found'], 404);
        }

        $validatedData = $request->validate([
            'currency_abbreviation' => 'required|string|max:10|unique:currencies,currency_abbreviation,' . $id,
            'currency_symbol' => 'required|string|max:10',
            'currency_name' => 'required|string|max:255',
            'hundredths_name' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'auto_exchange_rate_update' => 'sometimes|boolean'
        ]);

        $currency->update($validatedData);

        return response()->json($currency, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currency = Currency::find($id);

        if (!$currency) {
            return response()->json(['message' => 'Currency not found'], 404);
        }

        $currency->delete();

        return response()->json(['message' => 'Currency deleted']);
    }
}
