<?php

namespace App\Http\Controllers;

use App\Models\UserManagement;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UserManagement::select([
            "id", 
            "first_name", 
            "last_name", 
            "department", 
            "epf",
            "telephone", 
            "address", 
            "email", 
            "password",
            "role" ,
            "status"
        ])->get();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'epf' => 'required|string|max:50',
            'telephone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:user_managements,email',
            'password' => 'required|string|min:6',
            'role' => 'required',
            'status' => 'required',
            
        ]);

        $user = UserManagement::create([
            "first_name" => $validatedData['first_name'],
            "last_name" => $validatedData['last_name'],
            "department" => $validatedData['department'] ?? null, 
            "epf" => $validatedData['epf'],
            "telephone" => $validatedData['telephone'] ?? null, 
            "address" => $validatedData['address'] ?? null, 
            "email" => $validatedData['email'], 
            "password" => bcrypt($validatedData['password']), // hash password
            'role' => $validatedData['role'],
            'status' => $validatedData['status'],
        ]);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = UserManagement::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = UserManagement::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'epf' => 'required|string|max:50',
            'telephone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:user_managements,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'role' => 'required',
            'status' => 'required',
        ]);

        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->department = $validatedData['department'] ?? null;
        $user->epf = $validatedData['epf'];
        $user->telephone = $validatedData['telephone'] ?? null;
        $user->address = $validatedData['address'] ?? null;
        $user->email = $validatedData['email'];

        if (isset($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->role = $validatedData['role'];
        $user->status = $validatedData['status'];

        $user->save();

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        UserManagement::destroy($id);
        return response()->json(["message" => "User deleted"]);
    }
}
