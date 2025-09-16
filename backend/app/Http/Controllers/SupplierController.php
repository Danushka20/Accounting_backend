<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // List all suppliers
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    // Store a new supplier
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_short_name' => 'nullable|string|max:255',
            'gst_number' => 'nullable|string|max:50',
            'website' => 'nullable|string|max:255',
            'supplier_currency' => 'nullable|string|max:10',
            'tax_group' => 'nullable|string|max:100',
            'our_customer_no' => 'nullable|string|max:50',
            'bank_account' => 'nullable|string|max:100',
            'bank_name' => 'nullable|string|max:255',
            'credit_limit' => 'nullable|numeric',
            'payment_terms' => 'nullable|string|max:100',
            'prices_include_tax' => 'boolean',
            'accounts_payable' => 'nullable|string|max:255',
            'purchase_account' => 'nullable|string|max:255',
            'purchase_discount_account' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'secondary_phone' => 'nullable|string|max:50',
            'fax' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'document_language' => 'nullable|string|max:50',
            'mailing_address' => 'nullable|string',
            'physical_address' => 'nullable|string',
            'general_notes' => 'nullable|string',
        ]);

        $supplier = Supplier::create($validated);

        return response()->json($supplier, 201);
    }

    // Show a single supplier
    public function show($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }
        return response()->json($supplier);
    }

    // Update a supplier
    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_short_name' => 'nullable|string|max:255',
            'gst_number' => 'nullable|string|max:50',
            'website' => 'nullable|string|max:255',
            'supplier_currency' => 'nullable|string|max:10',
            'tax_group' => 'nullable|string|max:100',
            'our_customer_no' => 'nullable|string|max:50',
            'bank_account' => 'nullable|string|max:100',
            'bank_name' => 'nullable|string|max:255',
            'credit_limit' => 'nullable|numeric',
            'payment_terms' => 'nullable|string|max:100',
            'prices_include_tax' => 'boolean',
            'accounts_payable' => 'nullable|string|max:255',
            'purchase_account' => 'nullable|string|max:255',
            'purchase_discount_account' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'secondary_phone' => 'nullable|string|max:50',
            'fax' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'document_language' => 'nullable|string|max:50',
            'mailing_address' => 'nullable|string',
            'physical_address' => 'nullable|string',
            'general_notes' => 'nullable|string',
        ]);

        $supplier->update($validated);

        return response()->json($supplier);
    }

    // Delete a supplier
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted']);
    }
}
