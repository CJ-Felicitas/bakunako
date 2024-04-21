<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Schedule;
use App\Models\Infant;
use App\Models\Voucher;

class ScheduleController extends Controller
{
    public function verify_schedule_session(Request $request)
    {
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
            // DO NOT DELETE THIS UNCOMMENTED LINE
            /**
             *  the code commented code below is a function that releases the voucher to the parent
             */
            // $this->release_voucher($request->infant_id, $request->schedule_id);

            return response()->json([
                'status' => 'success',
                'message' => "$request->schedule_id has been updated successfully"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update schedule',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    // this function is exclusive to this controller that should be called in the verify_schedule_session function
    private function release_voucher($infant_id, $schedule_id)
    {
        try {
            $verify_schedule = Schedule::where('infants_id', $infant_id)
                ->where('id', $schedule_id)
                ->where('status', 'done')
                ->first();

            if ($verify_schedule) {
                $voucher = Voucher::where('infant_id', $infant_id)
                    ->where('voucher_type_id', $verify_schedule->vaccines_id)
                    ->first();

                if ($voucher) {
                    $voucher->reedamable = 1;
                    $voucher->save();
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update voucher status',
                'error' => $th->getMessage()
            ], 500);
        }
    }

}
