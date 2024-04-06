<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Hash;
use Carbon\Carbon;
use App\Enums\UserTypeEnum;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'confirm_password' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect('/register')->with('missing_field', 'Please fill in all the required fields')->withInput();
        }

        $validated = $validator->validated();

        // check if passwords are matched 
        if ($validated['password'] != $validated['confirm_password']) {
            return redirect('/register')->with('passwords_not_matched', 'Passwords do not match')->withInput();
        }

        // check if user is already in the database
        $existingUser = User::where([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name']
        ])->first();

        if ($existingUser) {
            return redirect('/register')->with('user_exists', 'Username already exists')->withInput();
        }

        // check if email is already taken
        $existingEmail = User::where('email', $validated['email'])->first();

        if ($existingEmail) {
            return redirect('/register')->with('email_exists', 'Email already exists')->withInput();
        }

        // save the user if all conditions are met
        try {
            $parent = new User();
            $parent->first_name = $validated['first_name'];
            $parent->middle_name = $validated['middle_name'];
            $parent->last_name = $validated['last_name'];
            $parent->phone_number = $validated['phone_number'];
            $parent->address = $validated['address'];
            $parent->user_type_id = UserTypeEnum::PARENT;
            $parent->username = $validated['username'];
            $parent->password = Hash::make($validated['password']);
            $parent->email = $validated['email'];
            $parent->created_at = Carbon::now();
            $parent->updated_at = Carbon::now();
            $parent->save();

            return "user saved";

        } catch (\Throwable $th) {
            return $th;
        }
    }
}
