<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Validator;
use DB;
use Hash;
use App\Models\Infant;
use App\Models\Voucher;

class HealthCareProviderController extends Controller
{
    public function view_infants_schedule()
    {
        // Get the current date
        $currentDate = Carbon::now()->toDateString();

        // Retrieve the first schedule for each infant based on the current date
        $schedules = Schedule::where('date', '2024-04-1')->get()->unique('infants_id');


        return view('site.healthcare_provider.dashboard', compact('schedules'));
    }

    public function view_vaccination_details($id)
    {
        $currentDate = Carbon::now()->toDateString();
        $infant = Infant::find($id);
        $schedules = Schedule::where('infants_id', $id)
            ->orderByRaw("CASE WHEN date = '{$currentDate}' THEN 0 WHEN date = '2024-05-16' THEN 1 ELSE 2 END")
            ->get();

        return view('site.healthcare_provider.vaccinationdetails', compact('schedules', 'infant'));
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
                return redirect("/healthcare_provider/vaccination_details/$schedule->infants_id")->with('password', 'Password is incorrect');
            }

            // check if the infant has a voucher allocated to its vaccine schedule
            $infant_id = $schedule->infants_id;
            $vaccine_id = $schedule->vaccine_id;

            // check if the infant has a voucher
            $voucher = Voucher::where('infant_id', $infant_id)
                ->whereHas('voucherType', function ($query) use ($vaccine_id) {
                    $query->where('vaccine_id', $vaccine_id);
                })->first();

            // if there is no voucher then proceed to normal schedule update
            if (!$voucher) {

                // start transaction for safety purposes
                DB::beginTransaction();
                
                // update the status of the schedule
                $schedule->status = $validated['status'];
                $schedule->remarks = $validated['remarks'];
                $schedule->save();
                
                // save the changes
                DB::commit();
                
                return redirect("/healthcare_provider/vaccination_details/$schedule->infants_id")->with('success', 'Status updated successfully');
            } elseif ($voucher) {
                DB::beginTransaction();
                // update the status of the schedule
                $schedule->status = $validated['status'];
                $schedule->remarks = $validated['remarks'];
                $schedule->save();

                // update the voucher status
                $voucher->reedamable = 1;
                $voucher->updated_at = Carbon::now();
                $voucher->save();

                // save changes
                DB::commit();
                
                // return back to the page with a success message
                return redirect("/healthcare_provider/vaccination_details/$schedule->infants_id")->with('success', 'Status updated successfully');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

    }
}
