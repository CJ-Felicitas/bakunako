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

        // check the current date and the date of the schedule and update status to missed if the date has passed
        foreach ($schedules as $schedule) {
            if ($schedule->date < $currentDate && $schedule->status == 'pending') {
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
                return redirect("/healthcare_provider/vaccination_details/$schedule->infants_id")->with('password', 'Password is incorrect');
            }

                // start transaction for safety purposes
                DB::beginTransaction();
                
                // update the status of the schedule
                $schedule->status = $validated['status'];
                $schedule->save();

                // check the active vouchers that are available for the infant
                $active_voucher = ActiveVoucher::where('vaccine_id', $schedule->vaccines_id)->first();
                $active_vouchertype = VoucherType::where('id', $active_voucher->voucher_type_id)->first();

                // check if the active_vouchertype has a remaining quantity
                if ($active_vouchertype->remaining_quantity > 0) {
                    // if there is still remaining then create new voucher
                    $voucher = new Voucher();
                    $voucher->voucher_type_id = $active_voucher->voucher_type_id;
                    $voucher->infant_id = $infant_id;
                    $random_code = $this->generateRandomString(2);
                    $voucher->voucher_code = $random_code . '' . $infant_id . '' . Carbon::now()->format('Ymd');
                    $voucher->is_reedeemable = 1;
                    $voucher->is_redeemed = 0;
                    $voucher->created_at = Carbon::now();
                    $voucher->updated_at = Carbon::now();
                    $voucher->save();

                    $active_vouchertype->remaining_quantity = $active_vouchertype->remaining_quantity - 1;
                    $active_vouchertype->save();
                }

                DB::commit();
               
                return redirect("/healthcare_provider/vaccination_details/$schedule->infants_id")->with('success', 'Status updated successfully');


            // check if the infant has a voucher allocated to its vaccine schedule
            // $infant_id = $schedule->infants_id;
            // $vaccine_id = $schedule->vaccines_id;



            // // return "infant_id: $infant_id, vaccine_id: $vaccine_id";
            // // check if the infant has a voucher
            // $voucher = Voucher::where('infant_id', $infant_id)
            //     ->whereHas('voucherType', function ($query) use ($vaccine_id) {
            //         $query->where('vaccine_id', $vaccine_id);
            //     })->first();

            // // if there is no voucher then proceed to normal schedule update
            // if (!$voucher) {

            //     // start transaction for safety purposes
            //     DB::beginTransaction();
                
            //     // update the status of the schedule
            //     $schedule->status = $validated['status'];
            //     $schedule->remarks = $validated['remarks'];
            //     $schedule->save();
                
            //     // save the changes
            //     DB::commit();
            //     // return "There is no voucher";
            //     return redirect("/healthcare_provider/vaccination_details/$schedule->infants_id")->with('success', 'Status updated successfully');
            // } elseif ($voucher) {
            //     DB::beginTransaction();
            //     // update the status of the schedule
            //     $schedule->status = $validated['status'];
            //     $schedule->remarks = $validated['remarks'];
            //     $schedule->save();

            //     // update the voucher status
            //     $voucher->is_reedeemable = 1;
            //     $voucher->updated_at = Carbon::now();
            //     $voucher->save();

            //     // update the voucher type remaining quantity
            //     // save changes
            //     DB::commit();
            //     // return "voucher updated";
            //     // return back to the page with a success message
            //     return redirect("/healthcare_provider/vaccination_details/$schedule->infants_id")->with('success', 'Status updated successfully');
            // }


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
}
