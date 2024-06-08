<?php

namespace App\Http\Controllers;

use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Validator;
use DB;
use Hash;
use App\Models\Infant;
use App\Models\Voucher;
use App\Models\ActiveVoucher;
use App\Models\User;

class HealthCareProviderController extends Controller
{
    // returns the infants that are scheduled for the current date for the vaccination
    public function view_infants_schedule()
    {
        // Get the current date
        $currentDate = Carbon::now()->toDateString();
        // Retrieve the first schedule for each infant based on the current date
        // CHANGE THE DATE HERE -------------------
        $schedules = Schedule::where('date', $currentDate)->get()->unique('infants_id');
        return view('site.healthcare_provider.dashboard', compact('schedules'));
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

        return view('site.healthcare_provider.vaccinationdetails', compact('schedules', 'infant'));
    }

    // updates or marks the infant if its either done vaccinated or not and also the remarks
    public function updateStatus(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'schedule_id' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // assign the data that has been validated
        $validated = $validator->validated();

        // check if the password is correct
        $user = auth()->user();
        $schedule = Schedule::find($validated['schedule_id']);

        if (!$schedule) {
            return redirect()->back()->with('error', 'Schedule not found');
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return redirect()->back()->with('error', 'Password is incorrect');
        }

        try {
            // start transaction for safety purposes
            DB::beginTransaction();

            // update the status of the schedule
            $schedule->remarks = $request->remarks;
            $schedule->status = $validated['status'];
            $schedule->save();

            $voucher_types = VoucherType::where('vaccine_id', $schedule->vaccines_id)->get();

            if ($schedule->check_voucher == null) {
                foreach ($voucher_types as $voucher_type) {
                    if ($voucher_type->remaining_quantity > 0) {
                        $voucher = new Voucher();
                        $voucher->voucher_type_id = $voucher_type->id;
                        $voucher->infant_id = $schedule->infants_id;
                        $random_code = $this->generateRandomString(2);
                        $voucher->voucher_code = $random_code . $schedule->infants_id . Carbon::now()->format('Ymd');
                        $voucher->is_reedeemable = 1;
                        $voucher->is_redeemed = 0;
                        $voucher->created_at = Carbon::now();
                        $voucher->updated_at = Carbon::now();

                        $voucher->save();
                        $schedule->check_voucher = "done";
                        $schedule->save();

                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Status updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
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
