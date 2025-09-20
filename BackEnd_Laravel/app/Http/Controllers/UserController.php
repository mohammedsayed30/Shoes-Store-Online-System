<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //get all users
    public function index(Request $request)
    {
        // Your logic to get all users
       $users = User::paginate(10);
        return response()->json($users);
    }
    //get user by id
    public function show($id)
    {
        // Your logic to get a user by ID
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }
    //update user by id
    public function update(Request $request, $id)
    {
        // Your logic to update a user by ID
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->update($request->all());
        return response()->json($user);
    }
    //delete user by id
    public function destroy($id)
    {
        // Your logic to delete a user by ID
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
    //register user
    public function register(Request $request)
    {
       //validate the request
        $validatedData= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        //create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'password' => bcrypt($validatedData['password']),
        ]);
        //return the user
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }
    //login user
    public function login(Request $request)
    {
        //validate the request
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        //attempt to login the user
        if (auth()->attempt($validatedData)) {
            $user = auth()->user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'User logged in successfully',
                'user' => $user,
                'token' => $token,
            ]);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    //logout user
    public function logout(Request $request)
    {
        //revoke the token
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }
    //get user profile account
    public function profileaccount(Request $request)
    {
        // Your logic to get user profile account
        $user = $request->user();
        return response()->json($user);
    }
    //get user profile orders
    public function profileorders(Request $request)
    {
        // Your logic to get user profile orders
        $user = $request->user();
        $orders = $user->orders; // Assuming you have a relationship defined
        return response()->json($orders);
    }
}
