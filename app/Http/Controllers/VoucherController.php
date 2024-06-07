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
            DB::beginTransaction();
            $voucher_type = new VoucherType();
            $voucher_type->partner_id = $partner->id;
            $voucher_type->item_name = $validated['item_name'];
            $voucher_type->total_quantity = $validated['total_quantity'];
            $voucher_type->remaining_quantity = $validated['total_quantity'];
            $voucher_type->vaccine_id = $vaccine->id;
            $voucher_type->save();

            // // set active voucher
            // $active_voucher = ActiveVoucher::where('vaccine_id', $vaccine->id)->first();

            // // check if there is already an active voucher_type_id exists
            // if (!$active_voucher->voucher_type_id) {
            //     $active_voucher->voucher_type_id = $voucher_type->id;
            //     $active_voucher->updated_at = Carbon::now();
            //     $active_voucher->save();
            // }
            DB::commit();

            return redirect()->back()->with('voucher_distribute_success', 'Voucher added successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
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

    public function claimVoucher($id, Request $request)
    {
        // first param is voucher id
        // second param is infant id
        $infant_id = $request->query('infantid');
        $vtype = $request->query('vtype');
        $vaccine_id = $request->query('vid');
        try {
            // check if the infant has already claimed two vouchers\
            $check_voucher = Voucher::where('infant_id', $infant_id)
                ->whereHas('voucherType', function ($query) use ($vaccine_id) {
                    $query->where('vaccine_id', $vaccine_id);
                })
                ->where('is_redeemed', 1)
                ->count();

            // return $check_voucher;
            // The specific voucher
            $voucher = Voucher::findOrFail($id);

            // the infant
            $infant = Infant::find($infant_id);

            if ($check_voucher > 0) {
                return redirect()->back()->with('limit_error', "The voucher for $infant->infant_firstname $infant->infant_lastname has already been claimed");
            }

            // the voucher type
            $voucher_type = VoucherType::find($voucher->voucher_type_id);

            if ($voucher->is_redeemed == 1) {
                return back()->with('already_claimed', 'Voucher has already been claimed');
            }

            if ($voucher->is_reedeemable == 1 && $voucher->is_redeemed == 0 && $voucher_type->remaining_quantity !== 0) {
                DB::beginTransaction();
                try {
                    // claim the voucher
                    $voucher->is_redeemed = 1;
                    $voucher->redeemed_at = Carbon::now('Asia/Manila');
                    $voucher->save();

                    $total_redeemed = Voucher::where('voucher_type_id', $voucher_type->id)
                        ->where('is_redeemed', 1)
                        ->count();

                    // update the voucher type status
                    $voucher_type->redeemed_quantity = $total_redeemed;
                    $voucher_type->remaining_quantity = $voucher_type->remaining_quantity - 1;
                    $voucher_type->save();

                    Voucher::where('infant_id', $infant_id)
                        ->whereHas('voucherType', function ($query) use ($vaccine_id) {
                            $query->where('vaccine_id', $vaccine_id);
                        })
                        ->where('is_redeemed', 0)
                        ->delete();


                    DB::commit();
                    return redirect()->back()->with('success', 'Voucher claimed successfully');

                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'An error occurred while claiming the voucher');
                }
            } elseif ($voucher->is_reedeemable == 0 && $voucher_type->remaining_quantity == 0) {
                return redirect()->back()->with('error', 'Voucher is not reedeemable');
            } elseif ($voucher_type->remaining_quantity == 0) {
                Voucher::where('id', $voucher->id)->delete();
                DB::commit();
             return redirect()->back()->with('voucher_empty', 'voucher is not available anymore');
            }

            return redirect()->back()->with('server_error', 'An unexpected error occurred');
        } catch (ModelNotFoundException $th) {
            return redirect()->back()->with('error', 'Voucher not found');
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

    public function updateActiveVoucher(Request $request)
    {
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
