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
        $vaccines = Vaccine::all();
        $vouchers = Voucher::all();
        $voucher_types = VoucherType::all();
        return view('site.admin.managevoucher', compact('partners', 'vaccines', 'vouchers', 'voucher_types'));
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
         * 
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

            // count the number of infants
            $infant_count = Infant::count();

            // if infant_count is smaller than the total quantity of voucher_type then all infants will be assigned a voucher
            $all_infants = Infant::all();
            if ($infant_count <= $validated['total_quantity']) {
                $count = 0;
                foreach ($all_infants as $infant) {
                    $voucher = new Voucher();
                    $voucher->voucher_type_id = $voucher_type->id;
                    $voucher->infant_id = $infant->id;
                    $voucher->voucher_code = $validated['item_name'] . $partner->id . $infant->id . $vaccine->id . $voucher->id;
                    $voucher->created_at = Carbon::now();
                    $voucher->updated_at = Carbon::now();
                    $voucher->save();
                    $count++;
                }
                // update the total remaining quantity of the voucher after the mass assignment
                $update_voucher_type = VoucherType::find($voucher_type->id);
                $current_quantity = $update_voucher_type->total_quantity;
                $update_voucher_type->remaining_quantity = $current_quantity - $count;
                $update_voucher_type->save();
            }

            // if the infant count is greater than the total quantity of the voucher type then perform a random allocation of voucher
            if ($infant_count > $validated['total_quantity']) {
                for ($i = 0; $i < $voucher_type->total_quantity; $i++) {
                    $voucher = new Voucher();
                    $voucher->voucher_type_id = $voucher_type->id;
                    $voucher->infant_id = rand(1, $infant_count);
                    $voucher->voucher_code = $validated['item_name'] . $partner->id . $voucher->infant_id . $vaccine->id . $voucher->id;
                    $voucher->created_at = Carbon::now();
                    $voucher->updated_at = Carbon::now();
                    $voucher->save();
                }
            }
            return redirect()->back()->with('voucher_distribute_success', 'Voucher added successfully');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
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
}
