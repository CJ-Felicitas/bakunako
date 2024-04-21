<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Validator;
use DB;
use Hash;
use App\Models\Infant;

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

            DB::beginTransaction();
            // update the status of the schedule
            $schedule->status = $validated['status'];
            $schedule->remarks = $validated['remarks'];
            $schedule->save();
            DB::commit();

            return redirect("/healthcare_provider/vaccination_details/$schedule->infants_id")->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
