<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // List all customers
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Store a new customer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_short_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'gst_number' => 'nullable|string|max:50',
            'currency' => 'required|string|max:10',
            'sales_type' => 'required|string|max:50',
            'phone' => 'nullable|string|max:50',
            'secondary_phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'bank_account' => 'nullable|string|max:100',
            'sales_person' => 'nullable|string|max:255',
            'discount_percent' => 'nullable|numeric',
            'prompt_payment_discount' => 'nullable|numeric',
            'credit_limit' => 'nullable|numeric',
            'payment_terms' => 'required|string|max:100',
            'credit_status' => 'required|string|max:100',
            'general_notes' => 'nullable|string',
            'default_inventory_location' => 'nullable|string|max:255',
            'default_shipping_company' => 'nullable|string|max:255',
            'sales_area' => 'nullable|string|max:255',
            'tax_group' => 'nullable|string|max:255',
        ]);

        $customer = Customer::create($validated);

        return response()->json($customer, 201);
    }

    // Show a single customer
    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    // Update customer
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_short_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'gst_number' => 'nullable|string|max:50',
            'currency' => 'required|string|max:10',
            'sales_type' => 'required|string|max:50',
            'phone' => 'nullable|string|max:50',
            'secondary_phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'bank_account' => 'nullable|string|max:100',
            'sales_person' => 'nullable|string|max:255',
            'discount_percent' => 'nullable|numeric',
            'prompt_payment_discount' => 'nullable|numeric',
            'credit_limit' => 'nullable|numeric',
            'payment_terms' => 'required|string|max:100',
            'credit_status' => 'required|string|max:100',
            'general_notes' => 'nullable|string',
            'default_inventory_location' => 'nullable|string|max:255',
            'default_shipping_company' => 'nullable|string|max:255',
            'sales_area' => 'nullable|string|max:255',
            'tax_group' => 'nullable|string|max:255',
        ]);

        $customer->update($validated);

        return response()->json($customer);
    }

    // Delete customer
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Customer deleted']);
    }
}
