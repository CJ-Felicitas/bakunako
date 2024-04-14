<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use DB;
class AdminController extends Controller
{
    public function addUser(Request $request)
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
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'username' => 'required',
            'phone_number' => 'required',
            'user_type_id' => 'required',
            'address' => 'required'
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
        $existing_user = User::where('first_name', $validated['first_name'])
        ->where('last_name', $validated['last_name'])
        ->where('email', $validated['email'])
        ->where('username', $validated['username'])
        ->first();

        if ($existing_user) {
            return "User already exists.";
        }

        try {
            DB::beginTransaction();
            $user = new User();
            $user->first_name = $validated["first_name"];
            $user->middle_name = $validated["middle_name"];
            $user->last_name = $validated["last_name"];
            $user->email = $validated["email"];
            $user->password = $validated["password"];
            $user->username = $validated["username"];
            $user->phone_number = $validated["phone_number"];
            $user->address = $validated["address"];
            $user->user_type_id = $validated["user_type_id"];
            $user->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }


    }
}
