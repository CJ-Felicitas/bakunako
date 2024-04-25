<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Enums\UserTypeEnum;
use Validator;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $user = Auth::user();

        if ($user->user_type_id == UserTypeEnum::ADMINISTRATOR) {
            return view('site.admin.profile', ['user' => $user]);
        }
        if ($user->user_type_id == UserTypeEnum::HEALTHCARE_PROVIDER) {
            return view('site.healthcareprovider.profile', ['user' => $user]);
        }
        if ($user->user_type_id == UserTypeEnum::PARENT) {
            return view('site.client.profile', ['user' => $user]);
        }
    }

    public function editProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'userid' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'address' => 'required',
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $validated = $validator->validate();

        try {
            // find and update the user
            $user = User::find($validated['userid']);
            $user->first_name = $validated['firstname'];
            $user->last_name = $validated['lastname'];
            $user->middle_name = $validated['middlename'];
            $user->email = $validated['email'];
            $user->phone_number = $validated['phonenumber'];
            $user->address = $validated['address'];
            $user->username = $validated['username'];
            $user->save();

            return redirect()->back()->with('editprofilesuccess', 'Profile updated successfully');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function updatepassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userid' => 'required',
            'password' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $validated = $validator->validate();

        try {
            $user = User::find($validated['userid']);
            if (password_verify($validated['password'], $user->password)) {
                if ($validated['newpassword'] == $validated['confirmpassword']) {
                    $user->password = bcrypt($validated['newpassword']);
                    $user->save();
                    return redirect()->back()->with('passwordchangesuccess', 'Password changed successfully');
                } else {
                    return redirect()->back()->with('passwordchangefailnotmatched', 'New password and confirm password do not match');
                }
            } else {
                return redirect()->back()->with('passwordchangefail', 'Old password is incorrect');
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}