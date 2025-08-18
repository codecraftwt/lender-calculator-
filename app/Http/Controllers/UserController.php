<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function add_user()
    {
        return view('auth.register');
    }

    public function store_user(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Check email is unique
            'role' => 'required|in:Admin,Broker',
            'password' => 'required|string|min:8|confirmed', // Confirms password matches confirmation
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'User created successfully.');
    }


    public function user_list()
    {

        return view('users.user_list');
    }

    public function get_users(Request $request)
    {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json($users);
    }

    public function update_user_status(Request $request)
    {
        $rules = [
            'id' => ['required', 'integer'],
            'deleted_flag' => ['required', 'integer'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $result = User::where('id', $request->id)->update(['deleted_flag' => $request->deleted_flag]);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Status Udpated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update the Status.'
            ]);
        }
    }

    public function  get_user_data(Request $request)
    {
        $rules = [
            'user_id' => ['required', 'integer'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $result = User::find($request->user_id);

        if ($result) {
            return response()->json($result);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed fetch the data'
            ]);
        }
    }


    public function update_user_data(Request $request)
    {
        $rules = [
            'user_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'role'    => ['required', 'in:Admin,Broker'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }


        $data =
            [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ];

        $result = User::where('id', $request->user_id)->update($data);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'User details Udpated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed update the user details.'
            ]);
        }
    }
}
