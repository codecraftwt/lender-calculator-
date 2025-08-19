<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordChangeOtpMail;

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

        $users = User::orderBy('id', 'desc');

        if ($request->has('role') && $request->role !== '' && $request->role !== null) {
            $users = $users->where('role', $request->role);
        }

        if ($request->has('status') && $request->status !== '' && $request->status !== null) {
            $users = $users->where('deleted_flag', $request->status);
        }
        $users = $users->get();

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

    public function update_user_profile(Request $request)
    {
        $rules = [
            'logged_user_id' => ['required', 'integer'],
            'user_name' => ['required', 'string'],
            'user_email' => ['required', 'email'],
            'user_role'    => ['required', 'in:Admin,Broker'],
            'profile_image' =>  ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
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
                'name' => $request->user_name,
                'email' => $request->user_email,
                'role' => $request->user_role,
            ];

        $existing_data = USer::select(['user_image', 'id'])
            ->where('id', $request->logged_user_id)
            ->first();


        if ($request->hasFile('profile_image')) {

            if ($existing_data->user_image && file_exists(public_path('assets/profile_images/' . $existing_data->id . '/' . $existing_data->user_image))) {
                unlink(public_path('assets/profile_images/' . $existing_data->id . '/' . $existing_data->user_image));
            }


            $file = $request->file('profile_image');
            $filename = strtolower($request->user_name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $folderPath = public_path('assets/profile_images/' . $request->logged_user_id);
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);  // Creates the directory with appropriate permissions
            }
            $file->move($folderPath, $filename);
            $data['user_image'] = $filename;
        }


        $result = User::where('id', $request->logged_user_id)->update($data);

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

    public function send_password_change_otp(Request $request)
    {
        $rules = [
            'user_id' => ['required', 'integer'],
            'user_mail' => ['required', 'email'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $otp = rand(100000, 999999);


        Mail::to($request->user_mail)->send(new PasswordChangeOtpMail($otp));

        $data = User::where('id', $request->user_id)->update(['otp' => $otp, 'otp_time' => now()]);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'OTP has been sent successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send the OTP.'
            ]);
        }
    }
}
