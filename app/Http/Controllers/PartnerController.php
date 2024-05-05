<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Validator;
use Carbon\Carbon;
use DB;

class PartnerController extends Controller
{
    public function addPartner(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required',
        //     'phone' => 'required',
        //     'address' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->with('error', 'Validation failed');
        // }

        // $validated = $validator->validated();

        try {
            DB::beginTransaction();
            $partner = new Partner();
            $partner->name = $request->name;
            $partner->email = $request->email;
            $partner->phone_number = $request->phone_number;
            $partner->address = $request->address;
            $partner->created_at = Carbon::now();
            $partner->updated_at = Carbon::now();
            $partner->save();
            DB::commit();
            return redirect()->back()->with('success', 'Partner added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function partner_view(){
        $partners = Partner::all();
        return view('site.admin.partner', compact('partners'));
    } 
}
