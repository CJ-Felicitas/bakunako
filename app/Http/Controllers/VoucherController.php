<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Partner;
use Validator;
use DB;
use App\Models\Vaccine;
use App\Models\Infant;
use App\Models\VoucherType;
use Carbon\Carbon;
use App\Models\ActiveVoucher;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VoucherController extends Controller
{

    public function detailed_voucher($id)
    {
        // detailed list of vouchers
        $vouchers = Voucher::where('voucher_type_id', $id)->get();
        $voucher_type = VoucherType::where('id', $id)->first();
        return view('site.admin.voucherlist', compact('vouchers', 'voucher_type'));
    }

    public function view_voucher()
    {
        // general view for voucher that returns the list of voucher_types
        $partners = Partner::all();
        $excludedNames = Vaccine::where('name', 'REGEXP', '[1-2]$')
            ->pluck('name')
            ->toArray();

        // Manually add "MMR 2" to the list of excluded names
        $excludedNames = array_diff($excludedNames, ['MMR 2']);

        $vaccines = Vaccine::whereNotIn('name', $excludedNames)->get();
        $vouchers = Voucher::all();
        $voucher_types = VoucherType::orderByDesc('remaining_quantity')->get();
        $active_vouchers = ActiveVoucher::all();

        return view('site.admin.managevoucher', compact('partners', 'vaccines', 'vouchers', 'voucher_types', 'active_vouchers'));
    }

    public function addVoucher(Request $request)
    {
        /**
         * expected payload
         * 
         * 1. Partner ID
         * 2. Name of Item
         * 3. Total Quantity
         * 4. vaccine_id
         */
        $validator = Validator::make($request->all(), [
            'partner_id' => 'required',
            'item_name' => 'required',
            'total_quantity' => 'required',
            'vaccine_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Validation failed');
        }
        $validated = $validator->validated();

        try {
            // check if partner exists
            $partner = Partner::find($validated['partner_id']);

            if (!$partner) {
                return redirect()->back()->with('error', 'Partner does not exist');
            }
            // check if vaccine exists
            $vaccine = Vaccine::find($validated['vaccine_id']);

            if (!$vaccine) {
                return redirect()->back()->with('error', 'Vaccine does not exist');
            }

            // create voucher type
            $voucher_type = new VoucherType();
            $voucher_type->partner_id = $partner->id;
            $voucher_type->item_name = $validated['item_name'];
            $voucher_type->total_quantity = $validated['total_quantity'];
            $voucher_type->remaining_quantity = $validated['total_quantity'];
            $voucher_type->vaccine_id = $vaccine->id;
            $voucher_type->save();

            // set active voucher
            $active_voucher = ActiveVoucher::where('vaccine_id', $vaccine->id)->first();

            // check if there is already an active voucher_type_id exists
            if (!$active_voucher->voucher_type_id) {
                $active_voucher->voucher_type_id = $voucher_type->id;
                $active_voucher->updated_at = Carbon::now();
                $active_voucher->save();
            }



            // count the number of infants
            // $infant_count = Infant::count();

            // // if infant_count is smaller than the total quantity of voucher_type then all infants will be assigned a voucher
            // $all_infants = Infant::all();
            // if ($infant_count <= $validated['total_quantity']) {
            //     $count = 0;
            //     foreach ($all_infants as $infant) {
            //         $filter_item_name = str_replace(' ', '', $validated['item_name']);
            //         $random_code = $this->generateRandomString(2);
            //         $voucher = new Voucher();
            //         $voucher->voucher_type_id = $voucher_type->id;
            //         $voucher->infant_id = $infant->id;
            //         $voucher->voucher_code = $filter_item_name . $random_code . "" . Carbon::now()->format('Ymd') . "" . $count;
            //         $voucher->created_at = Carbon::now();
            //         $voucher->updated_at = Carbon::now();
            //         $voucher->save();
            //         $count++;
            //     }
            //     // update the total remaining quantity of the voucher after the mass assignment
            //     $update_voucher_type = VoucherType::find($voucher_type->id);
            //     $current_quantity = $update_voucher_type->total_quantity;
            //     $update_voucher_type->remaining_quantity = $current_quantity - $count;
            //     $update_voucher_type->save();
            // }

            // // if the infant count is greater than the total quantity of the voucher type then perform a random allocation of voucher
            // if ($infant_count > $validated['total_quantity']) {
            //     $count = 0;
            //     for ($i = 0; $i < $voucher_type->total_quantity; $i++) {
            //         $current_quantity =
            //             $filter_item_name = str_replace(' ', '', $validated['item_name']);
            //         $random_code = $this->generateRandomString(2);
            //         $voucher = new Voucher();
            //         $voucher->voucher_type_id = $voucher_type->id;
            //         $voucher->infant_id = rand(1, $infant_count);
            //         $voucher->voucher_code = $filter_item_name . $random_code . "" . Carbon::now()->format('Ymd') . "" . $count;
            //         $voucher->created_at = Carbon::now();
            //         $voucher->updated_at = Carbon::now();
            //         $voucher->save();
            //         $count++;
            //     }
            //     $update_voucher_type = VoucherType::find($voucher_type->id);
            //     $current_quantity = $update_voucher_type->total_quantity;
            //     $update_voucher_type->remaining_quantity = $current_quantity - $count;
            //     $update_voucher_type->save();
            // }
            return redirect()->back()->with('voucher_distribute_success', 'Voucher added successfully');
        } catch (\Throwable $th) {
            return $th->getMessage();
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

    public function claimVoucher($id)
    {
        // id = voucher id
        try {
            $voucher = Voucher::findOrFail($id);
            $voucher_type = VoucherType::where('id', $voucher->voucher_type_id)->first();

            if ($voucher->is_redeemed == 1) {
                return back()->with('already_claimed', 'Voucher has already been claimed');
            }

            if ($voucher->is_reedeemable == 1 && $voucher->is_redeemed == 0) {
                // claim the voucher
                $voucher->is_redeemed = 1;
                $voucher->redeemed_at = Carbon::now();
                $voucher->save();

                $total_redeemed = Voucher::where('voucher_type_id', $voucher_type->id)->where('is_redeemed', 1)->count();

                // update the voucher type status
                $voucher_type->redeemed_quantity = $total_redeemed;
                $voucher_type->save();

                return redirect('/parent/voucher')->with('success', 'Voucher claimed successfully');
            } elseif ($voucher->is_reedeemable == 0) {
                return redirect('/parent/voucher')->with('error', 'Voucher is not reedeemable');
            }
        } catch (ModelNotFoundException $th) {
            return $th->getMessage();
        }
    }

    public function vaccines_associated_with_voucher(Request $request)
    {
        // for ajax request in the site.admin.managevouchers.blade.php
        try {
            // get all the voucher types that has the vaccine_id
            $vaccine_id = $request->vaccine_id;
            $voucher_types = VoucherType::where('vaccine_id', $vaccine_id)->get();
            return response()->json($voucher_types);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function updateActiveVoucher(Request $request){
        // start validation
        $validator = Validator::make($request->all(), [
            'voucher_type_id' => 'required',
            'vaccine_id' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Validation failed');
        }

        $validated = $validator->validated();

        try {
            // check if the password is correct
            $user = auth()->user();
            if (!Hash::check($validated['password'], $user->password)) {
                return redirect()->back()->with('error', 'Password is incorrect');
            }

            // check if the voucher type exists
            $voucher_type = VoucherType::find($validated['voucher_type_id']);
            if (!$voucher_type) {
                return redirect()->back()->with('error', 'Voucher type does not exist');
            }

            // check if the vaccine exists
            $vaccine = Vaccine::find($validated['vaccine_id']);
            if (!$vaccine) {
                return redirect()->back()->with('error', 'Vaccine does not exist');
            }

            // update the active voucher
            $active_voucher = ActiveVoucher::where('vaccine_id', $vaccine->id)->first();
            $active_voucher->voucher_type_id = $voucher_type->id;
            $active_voucher->updated_at = Carbon::now();
            $active_voucher->save();

            return redirect()->back()->with('success', 'Active voucher updated successfully');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
