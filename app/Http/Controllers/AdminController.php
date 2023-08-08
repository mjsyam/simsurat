<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getUsers(Request $request)
    {
        $page = $request->page ?? 1;
        $itemCount = $request->itemCount ?? 10;

        $users = User::paginate($itemCount, ['*'], 'page', $page);

        // Create an array with the required data
        $responseData = [
            'currentPage' => $users->currentPage(),
            'itemCount' => $itemCount,
            'data' => $users->items(),
        ];

        return response()->json($responseData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'string|unique:users,email',
            'password' => 'string|min:8|confirmed',
            'signature' => 'string|nullable',
            'avatar' => 'string|nullable',
        ]);

        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']); // Hash the password
        }

        $user = User::create($data); // Create a new user with the provided data

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editUser(string $id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUser(Request $request, string $id)
    {
        $request->validate([
            'name' => 'string|nullable',
            'email' => 'string|nullable',
            'password' => 'string|nullable|min:8|confirmed',
            'signature' => 'string|nullable',
            'avatar' => 'string|nullable',
        ]);

        $user = User::findOrFail($id);

        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']); // Hash the password
        }
        $user->update($data);

        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyUser(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
