<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use DB;
use App\Models\Infant;
use Hash;
class AdminController extends Controller
{
    public function addUser_(Request $request)
    {
        /**
         * expected payload:
         * - first_name
         * - last_name
         * - middle_name
         * - email
         * - password
         * - username
         * - phone number
         * - user_type_id
         * - address    
         */

        // validate the request if there is the expected payload
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'email' => 'required',
            'password' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
            'user_type_id' => 'required',
            'address' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        // assign the validated data to the $validated variable
        $validated = $validator->validate();

        // check if username is already taken
        $existing_username = User::where('username', $validated['username'])->first();

        if ($existing_username) {
            return "Username is already taken. Please try another one.";
        }

        // check if email is already taken
        $existing_email = User::where('email', $validated['email'])->first();
        if ($existing_email) {
            return "Email is already taken. Please try another one.";
        }

        // scan if there is already a user
        $existing_user = User::where('first_name', $validated['firstname'])
            ->where('last_name', $validated['lastname'])
            ->where('email', $validated['email'])
            ->where('username', $validated['username'])
            ->first();

        // check the confirm password
        if($validated['password'] != $validated['confirm_password']){
            return "mali ang password";
        }

        if ($existing_user) {
            return "User already exists.";
        }

        try {
            DB::beginTransaction();
            $user = new User();
            $user->first_name = $validated["firstname"];
            $user->middle_name = $validated["middlename"];
            $user->last_name = $validated["lastname"];
            $user->email = $validated["email"];
            $user->password = Hash::make($validated["password"]);
            $user->username = $validated["username"];
            $user->phone_number = $validated["phone_number"];
            $user->address = $validated["address"];
            $user->user_type_id = $validated["user_type_id"];
            $user->save();
            DB::commit();

            return redirect()->back()->with('success', 'register success');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    public function dashboard_view()
    {
        $male_count = Infant::where('sex', 'Male')->count();
        $female_count = Infant::where('sex', 'Female')->count();
        $total = $male_count + $female_count;
        return view('site.admin.dashboard', [
            'male_count' => $male_count,
            'female_count' => $female_count,
            'total' => $total
        ]);

    }

    public function add_user_view()
    {
        return view('site.admin.adduser');
    }
}
