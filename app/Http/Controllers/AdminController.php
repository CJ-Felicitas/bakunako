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
            // 'user_type_id' => 'required', // this one is not applicable anymore because only one admin should exist
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
        if ($validated['password'] != $validated['confirm_password']) {
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
            $user->user_type_id = UserTypeEnum::HEALTHCARE_PROVIDER;
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
        return view('site.admin.adduser');
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
        $schedules = Schedule::where('date', '2024-05-01')->get()->unique('infants_id');

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

        // check the current date and the date of the schedule and update status to missed if the date has passed
        foreach ($schedules as $schedule) {
            if ($schedule->date < $currentDate && $schedule->status == 'pending') {
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
            'remarks' => 'required',
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
            if (!Hash::check($validated['password'], $user->password)) {
                return redirect("/admin/vaccination_details/$schedule->infants_id")->with('password', 'Password is incorrect');
            }

            DB::beginTransaction();
            // update the status of the schedule
            $schedule->status = $validated['status'];
            $schedule->remarks = $validated['remarks'];
            $schedule->save();
            DB::commit();

            return redirect("/admin/vaccination_details/$schedule->infants_id")->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
