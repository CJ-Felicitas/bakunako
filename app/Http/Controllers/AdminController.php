<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use DB;
use App\Models\Infant;
use Hash;
use App\Enums\UserTypeEnum;
use App\Models\Feedback;
use App\Models\Schedule;
use Carbon\Carbon;
use App\Models\ActiveVoucher;
use App\Models\Voucher;
use App\Models\VoucherType;
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
         * - assigned_at
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
            // 'user_type_id' => 'required', // this one is not applicable anymore because only one admin should exist
            'address' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // assign the validated data to the $validated variable
        $validated = $validator->validate();

        // check if username is already taken
        $existing_username = User::where('username', $validated['username'])->first();

        if ($existing_username) {
            return redirect()->back()->with('username_exists', 'asdassd');
        }

        // check if email is already taken
        $existing_email = User::where('email', $validated['email'])->first();
        if ($existing_email) {
            redirect()->back()->with('email_exists', 'asdassd');
        }

        // scan if there is already a user
        $existing_user = User::where('first_name', $validated['firstname'])
            ->where('last_name', $validated['lastname'])
            ->where('email', $validated['email'])
            ->where('username', $validated['username'])
            ->first();

        // check the confirm password
        if ($validated['password'] != $validated['confirm_password']) {
            return redirect()->back()->with('password_wrong', 'asdassd');
        }

        if ($existing_user) {
            return redirect()->back()->with('user_exists', 'asdassd');
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
            $user->user_type_id = UserTypeEnum::HEALTHCARE_PROVIDER;
            $user->assigned_at = $request->assigned_at;
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
        $infants = Infant::all();
        return view('site.admin.dashboard', [
            'male_count' => $male_count,
            'female_count' => $female_count,
            'total' => $total,
            'infants' => $infants
        ]);
    }
    public function add_user_view()
    {

        $users = User::where('user_type_id', 3)->get();
        return view('site.admin.adduser', compact('users'));
    }

    public function view_feedbacks()
    {
        $feedbacks = Feedback::all();

        return view('site.admin.feedbacks', [
            'feedbacks' => $feedbacks
        ]);
    }

    public function show($id)
    {
        try {
            $infant = Infant::findOrFail($id);
            $schedules = Schedule::where('infants_id', $infant->id)->get();
            return view('site.admin.infantinfo', compact('infant', 'schedules'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function profile()
    {
        return view('site.admin.profile');
    }

    // vaccination operations or functions
    public function view_infants_schedule()
    {
        // Get the current date
        $currentDate = Carbon::now()->toDateString();

        // Retrieve the first schedule for each infant based on the current date
        // NOTE:::::::::::: PLEASE READE ME, CHANGE THE DATE TO THE CURRENT DATE IF DEPLOYED IN PROD
        $schedules = Schedule::where('date', $currentDate)->get()->unique('infants_id');

        foreach ($schedules as $schedule) {
            if ($schedule->date < $currentDate && $schedule->status == 'pending') {
                $schedule->status = 'missed';
                $schedule->remarks = 'missed';
                $schedule->save();
            }
        }

        return view('site.admin.manage', compact('schedules'));
    }

    public function view_vaccination_details($id)
    {
        $currentDate = Carbon::now()->toDateString();
        $infant = Infant::find($id);
        $schedules = Schedule::where('infants_id', $id)->get();

        // Check the current date and the date of the schedule and update status to missed if the date has passed
        foreach ($schedules as $schedule) {
            // Check if the date is not null before proceeding
            if ($schedule->date && $schedule->date < $currentDate && $schedule->status == 'pending') {
                $schedule->status = 'missed';
                $schedule->remarks = 'missed';
                $schedule->save();
            }
        }

        return view('site.admin.vaccinationdetails', compact('schedules', 'infant'));
    }


    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'schedule_id' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        // assign the data that has been validated
        $validated = $validator->validated();

        // check if the password is correct via try catch
        try {
            $user = auth()->user();
            $schedule = Schedule::find($validated['schedule_id']);
            $infant_id = $schedule->infants_id;
            $vaccine_id = $schedule->vaccines_id;

            if (!Hash::check($validated['password'], $user->password)) {
                return redirect()->back()->with('password', 'Password is incorrect');
            }

            // start transaction for safety purposes
            DB::beginTransaction();

            // update the status of the schedule
            $schedule->remarks = $request->remarks;
            $schedule->status = $validated['status'];
            $schedule->save();

            // get all the voucher types and iterate each one of them to create a new voucher for the user
            $voucher_types = VoucherType::where('vaccine_id', $vaccine_id)->get();

            // start creating the voucher
            foreach ($voucher_types as $voucher_type) {
                $voucher = new Voucher();
                $voucher->voucher_type_id = $voucher_type->id;
                $voucher->infant_id = $infant_id;
                $random_code = $this->generateRandomString(2);
                $voucher->voucher_code = $random_code . '' . $infant_id . '' . Carbon::now()->format('Ymd');
                $voucher->is_reedeemable = 1;
                $voucher->is_redeemed = 0;
                $voucher->created_at = Carbon::now();
                $voucher->updated_at = Carbon::now();
                $voucher->save();

                // // update the remaining quantity of the voucher
                // $voucher_type->remaining_quantity = $voucher_type->remaining_quantity - 1;
                // $voucher_type->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    private function generateRandomString($length = 12)
    {
        // the purpose of this function is to generate a random string of characters for the voucher's code
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
