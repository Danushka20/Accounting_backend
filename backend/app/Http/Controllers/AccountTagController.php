<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountTag;

class AccountTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(AccountTag::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|integer',
            'name' => 'required|string|max:30',
            'description' => 'nullable|string|max:60',
            'inactive' => 'boolean',
        ]);

        $tag = AccountTag::create($validated);
        return response()->json($tag, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = AccountTag::find($id);
        if (!$tag) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($tag, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tag = AccountTag::find($id);
        if (!$tag) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $validated = $request->validate([
            'type' => 'integer',
            'name' => 'string|max:30',
            'description' => 'nullable|string|max:60',
            'inactive' => 'boolean',
        ]);

        $tag->update($validated);
        return response()->json($tag, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = AccountTag::find($id);
        if (!$tag) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $tag->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
