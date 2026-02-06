<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AdminAuditLog;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordChangeOtpMail;
use App\Mail\UserUpdatedByAdmin;

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
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Admin,Broker',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $result =  User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($result) {
            return redirect()->back()->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to store user details.');
        }
    }


    public function user_list()
    {

        return view('users.user_list');
    }

    public function get_users(Request $request)
    {


        if ($request->isMethod('get')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unsupported method requested'
            ], 405);
        }

        $users = User::orderBy('deleted_flag', 'asc')->orderBy('id', 'desc');

        if ($request->has('role') && $request->role !== '' && $request->role !== null) {
            $users = $users->where('role', $request->role);
        }

        if ($request->has('status') && $request->status !== '' && $request->status !== null) {
            $users = $users->where('deleted_flag', $request->status);
        }
        $users = $users->get();

        return response()->json($users);
    }

    public function activity_logs()
    {
        $users = User::select('users.name', 'users.id')->where('role', 'Admin')->get();
        $actions = AdminAuditLog::select('action')
            ->distinct()
            ->pluck('action');

        return view('users.activity_logs', compact('users', 'actions'));
    }

    public function get_activity_logs(Request $request)
    {
        $logs = AdminAuditLog::select(
            'admin_audit_logs.*',
            'u.name as user_name',
            'a.name as admin_name',
            'a.role as admin_role'
        )
            ->join('users as u', 'admin_audit_logs.user_id', '=', 'u.id')
            ->join('users as a', 'admin_audit_logs.admin_id', '=', 'a.id')
            ->addSelect(DB::raw("DATE_FORMAT(admin_audit_logs.created_at, '%d %b %Y, %h:%i %p') as formatted_date"))
            ->orderBy('admin_audit_logs.id', 'desc');

        if ($request->has('role') && $request->role !== '' && $request->role !== null) {
            $logs = $logs->where('admin_audit_logs.admin_id', $request->role);
        }

        if ($request->has('status') && !empty($request->status)) {
            $logs = $logs->whereDate('admin_audit_logs.created_at', $request->status);
        }

        if ($request->has('action') && !empty($request->action)) {
            $logs = $logs->where('admin_audit_logs.action', $request->action);
        }

        $logs = $logs->get();

        return response()->json($logs);
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


    // public function update_user_data(Request $request)
    // {

    //     $user = auth()->user();

    //     $rules = [
    //         'user_id' => ['required', 'integer'],
    //         'name' => ['required', 'string'],
    //         'email' => ['required', 'email'],
    //         'role'    => ['required', 'in:Admin,Broker'],

    //         'password' => [
    //             'nullable',
    //             'string',
    //             'confirmed',
    //         ],
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }


    //     $data =
    //         [
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'role' => $request->role,
    //         ];

    //     if ($request->filled('password') && $user->role === 'Admin') {
    //         $data['password'] = Hash::make($request->password);
    //     }



    //     $result = User::where('id', $request->user_id)->update($data);

    //     if ($result) {
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'User details Updated successfully.'
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed update the user details.'
    //         ]);
    //     }
    // }

    public function update_user_data(Request $request)
    {
        $admin = auth()->user();

        $rules = [
            'user_id'  => ['required', 'integer'],
            'name'     => ['required', 'string'],
            'email'    => ['required', 'email'],
            'role'     => ['required', 'in:Admin,Broker'],
            'password' => ['nullable', 'string', 'confirmed'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::findOrFail($request->user_id);

        // 🔹 Keep original data for comparison
        $originalUser = $user->replicate();

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        $passwordChanged = false;

        if ($request->filled('password') && $admin->role === 'Admin') {
            $data['password'] = Hash::make($request->password);
            $passwordChanged = true;
        }

        // 🔹 Update user
        $user->update($data);

        // 🔹 Track if anything changed (for email)
        $changesForEmail = [];

        // 🔹 Log EACH change separately

        if ($originalUser->name !== $user->name) {
            adminAuditLog(
                'NAME_UPDATED',
                'Admin updated user name',
                $user->id
            );
            $changesForEmail[] = 'Name updated';
        }

        if ($originalUser->email !== $user->email) {
            adminAuditLog(
                'EMAIL_UPDATED',
                'Admin updated user email',
                $user->id
            );
            $changesForEmail[] = 'Email updated';
        }

        if ($originalUser->role !== $user->role) {
            adminAuditLog(
                'ROLE_UPDATED',
                'Admin updated user role',
                $user->id
            );
            $changesForEmail[] = 'Role updated';
        }

        if ($passwordChanged) {
            adminAuditLog(
                'PASSWORD_CHANGED',
                'Admin changed user password',
                $user->id
            );
            $changesForEmail[] = 'Password changed';
        }

        // 🔹 Send ONE email if anything changed
        // if ($passwordChanged) {
        //     Mail::to($user->email)->send(
        //         new UserUpdatedByAdmin($user, $admin, $changesForEmail)
        //     );
        // }

        return response()->json([
            'status'  => 'success',
            'message' => 'User details updated successfully.'
        ]);
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
