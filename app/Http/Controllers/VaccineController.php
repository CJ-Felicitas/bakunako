<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Schedule;
use DB;

class VaccineController extends Controller
{
    public function verify_vaccine_session(Request $request)
    {
        /**
         * expected payload:
         * - schedule_id
         * - infant_id
         * - vaccine_id
         * - date
         * - time
         * - dose_number
         * - remarks
         * - last_updated_by
         * - status
         * 
         */

        // $validation = Validator::make($request->all(), [
        //     'schedule_id' => 'required',
        //     'infant_id' => 'required',
        //     'vaccine_id' => 'required',
        //     'date' => 'required',
        //     'time' => 'required',
        //     'dose_number' => 'required',
        //     'remarks' => 'required',
        //     'last_updated_by' => 'required',
        //     'status' => 'required'
        // ]);

        // // to be changed since there is still no UI for this
        // if ($validation->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Validation failed',
        //         'errors' => $validation->errors()
        //     ], 400);
        // }

        // check if the schedule exists
        $schedule = Schedule::find($request->schedule_id);
        if (!$schedule) {
            return response()->json([
                'status' => 'error',
                'message' => 'Schedule not found'
            ], 404);
        }

        try {
            DB::beginTransaction();
            $schedule_update = Schedule::where('id', $request->schedule_id)
                ->update([
                    'status' => $request->status,
                    'remarks' => $request->remarks,
                    'last_updated_by' => $request->last_updated_by
                ]);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => "$request->schedule_id has been updated successfully"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update schedule'
            ], 500);
        }
    }
}
