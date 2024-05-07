<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Validator;
use Carbon\Carbon;
use DB;
use Hash;
use Auth;

class PartnerController extends Controller
{
    public function addPartner(Request $request)
    {
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

    public function partner_view()
    {
        $partners = Partner::all();
        return view('site.admin.partner', compact('partners'));
    }

    public function partner_delete(Request $request)
    {
        try {
            $partner = Partner::findOrFail($request->partner_id);
            $password = $request->password;
            // check if the current password of the current authenticated user matches
            if (!Hash::check($password, Auth::user()->password)) {
                return "password does not match";
            }
            if ($partner) {
                try {
                    $partner->delete();
                } catch (\Throwable $th) {
                    return $th->getMessage();
                }
            }
            return redirect()->back()->with('delete_success', 'Partner deleted successfully');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
