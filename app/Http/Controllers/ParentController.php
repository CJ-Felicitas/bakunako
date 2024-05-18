<?php

namespace App\Http\Controllers;

use App\Enums\VaccinesEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;
use App\Models\Infant;
use App\Models\Voucher;
use App\Models\VoucherType;
use App\Models\Vaccine;
use App\Models\Schedule;
use App\Http\Controllers\Smscontroller;
use Auth;
use DB;
use Twilio\Rest\Client;
use Hash;
use App\Models\User;


class ParentController extends Controller
{
    // [please do not touch this]
    // private $servicePlanId = 'e83586985e474afbb7eaadf8b74027ec';
    // private $bearerToken = '464b03a0a45040dfb7e0754139fa4cba';
    // private $sendFrom = '+447520651553';


    protected $smsController;

    public function __construct(SmsController $smsController)
    {
        $this->smsController = $smsController;
    }

    // this is the current function that is working right now
    private function twilio($phone_numberIn, $messageIn)
    {
        try {
            $sid = config('app.sms_sid');
            $token = config('app.sms_token');
            $client = new Client($sid, $token);

            $number = $phone_numberIn;
            $message = $messageIn;

            $client->messages->create(
                "$number",
                [
                    'from' => '+13148200519',
                    'body' => "$message"
                ]
            );

            return $client;

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    // this function is not currently working right now due to API issues to the server [please do not touch this]

    // private function sendSms($phoneNumber, $message)
    // {
    //     // Check if phoneNumber is a string, if so, convert it to an array
    //     if (!is_array($phoneNumber)) {
    //         $phoneNumber = explode(',', $phoneNumber);
    //     }

    //     // Set necessary fields to be JSON encoded
    //     $content = [
    //         'to' => array_values($phoneNumber),
    //         'from' => $this->sendFrom,
    //         'body' => $message
    //     ];

    //     $data = json_encode($content);

    //     // Make API call
    //     $ch = curl_init("https://us.sms.api.sinch.com/xms/v1/{$this->servicePlanId}/batches");
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
    //     curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $this->bearerToken);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //     $result = curl_exec($ch);

    //     if (curl_errno($ch)) {
    //         throw new \Exception('Curl error: ' . curl_error($ch));
    //     }

    //     curl_close($ch);

    //     return $result;
    // }

    // get the dashboard page of the infant
    public function index()
    {
        // get all the infants of the currently authenticated user
        $infants = Infant::where('user_id', auth()->user()->id)->get();
        return view('site.client.dashboard', compact('infants'));
    }


    // get all the infant details
    public function show($id)
    {
        try {
            DB::beginTransaction();
            $currentDate = Carbon::now()->toDateString();
            $infant = Infant::findOrFail($id);
            $schedules = Schedule::where('infants_id', $infant->id)->get();
            foreach ($schedules as $schedule) {
                if ($schedule->date < $currentDate && $schedule->status == 'pending') {
                    $schedule->status = 'missed';
                    $schedule->remarks = 'missed';
                    $schedule->save();
                }
            }
            DB::commit();
            return view('site.client.infantinfo', compact('infant', 'schedules'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    // store the infant details
    public function store(Request $request)
    {
        DB::beginTransaction();
        // validate if all fields are present during passing the payload
        $validator = Validator::make($request->all(), [
            'infant_firstname' => 'required',
            'infant_lastname' => 'required',
            'infant_middlename' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'father_firstname' => 'required',
            'father_lastname' => 'required',
            'father_middlename' => 'required',
            'mother_firstname' => 'required',
            'mother_lastname' => 'required',// parent is the target user

            'mother_middlename' => 'required',
        ]);

        // kill the function and return to the page if the validation fails
        if ($validator->fails()) {
            return redirect('/parent/addinfant')->with('error', 'Please fill in all the required fields');
        }

        // pass the validated data to a variable if the validation is all good
        $validated = $validator->validated();

        // check if infant is already registered
        $already_registered = Infant::where('infant_firstname', $validated['infant_firstname'])
            ->where('infant_lastname', $validated['infant_lastname'])
            ->where('infant_middlename', $validated['infant_middlename'])
            ->where('date_of_birth', $validated['date_of_birth'])
            ->where('place_of_birth', $validated['place_of_birth'])
            ->first();

        // kill the function and return to the page if the infant is already registered
        if ($already_registered) {
            return redirect('/parent/addinfant')->with('already_registered', 'Infant already registered');
        }

        // save the infant to the records if there are no issues in the duplication check and validation check
        try {
            // save the infant to the records
            $infant = new Infant();
            $infant->infant_firstname = $validated['infant_firstname'];
            $infant->infant_lastname = $validated['infant_lastname'];
            $infant->infant_middlename = $validated['infant_middlename'];
            $infant->date_of_birth = $validated['date_of_birth'];
            $infant->place_of_birth = $validated['place_of_birth'];
            $infant->sex = $validated['sex'];
            $infant->address = $validated['address'];
            $infant->father_firstname = $validated['father_firstname'];
            $infant->father_lastname = $validated['father_lastname'];
            $infant->father_middlename = $validated['father_middlename'];
            $infant->mother_firstname = $validated['mother_firstname'];
            $infant->mother_lastname = $validated['mother_lastname'];
            $infant->mother_middlename = $validated['mother_middlename'];
            $infant->user_id = auth()->user()->id;
            $infant->created_at = Carbon::now();
            $infant->updated_at = Carbon::now();
            $infant->save();

            // loop through the vaccines and to assign a schedule to the infant to the schedules table
            $vaccines = Vaccine::all();
            foreach ($vaccines as $vaccine) {
                $schedule = new Schedule();
                $schedule->infants_id = $infant->id;
                $schedule->vaccines_id = $vaccine->id;
                $schedule->date = Carbon::parse($infant->date_of_birth)->addDays($vaccine->days_count);
                // add a time from 8am to 5pm
                $schedule->time_schedule_start = Carbon::parse('08:00:00');
                $schedule->time_schedule_end = Carbon::parse('15:00:00');
                $schedule->dose_number = $vaccine->dose_number;
                // $schedule->healthcare_provider_id = Auth::user()->id; -> this is the old code but it is now nullable
                $schedule->status = 'pending';
                // $schedule->remarks = 'pending'; -> this is the old code but it is now nullable
                $schedule->created_at = Carbon::now();
                $schedule->updated_at = Carbon::now();
                $schedule->save();
            }

            DB::commit();

            // firstname of the infant
            $infant_firstname = $validated['infant_firstname'];
            // lastname of the infant
            $infant_lastname = $validated['infant_lastname'];

            try {
                $user = Auth::user();
                $phone_number = $user->phone_number;

                $message = "Hello there $user->first_name $user->last_name, your baby $infant_firstname $infant_lastname has a vaccination schedule for BCG and Hepatitis B today!";

                $this->twilio($phone_number, $message);
            } catch (\Throwable $th) {
                //throw $th;
            }
            return redirect('/parent/dashboard')->with('success', 'Infant added successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }


    // bcg
    public function voucher_rewards_view()
    {
        $current_user = auth()->user();
        $id = $current_user->id;

        $BCG = VaccinesEnum::BCG;


        // bcg
        $BCGs = Voucher::where('is_reedeemable', 1)
            ->whereHas('voucherType', function ($query) use ($BCG) {
                $query->where('vaccine_id', $BCG);
            })
            ->whereHas('infant', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();

        return view('site.client.voucher', compact('BCGs'));
    }

    public function voucher_rewards_view_mmr()
    {
        $current_user = auth()->user();
        $id = $current_user->id;
        $MMR = VaccinesEnum::MMR;

        // mmr
        $MMRs = Voucher::where('is_reedeemable', 1)
            ->whereHas('voucherType', function ($query) use ($MMR) {
                $query->where('vaccine_id', $MMR);
            })
            ->whereHas('infant', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();

        return view('site.client.mmrvoucher', compact('MMRs'));
    }

    public function voucher_rewards_view_pcv()
    {
        $current_user = auth()->user();
        $id = $current_user->id;
        $PCV = VaccinesEnum::PCV;

        // pcv
        $PCVs = Voucher::where('is_reedeemable', 1)
            ->whereHas('voucherType', function ($query) use ($PCV) {
                $query->where('vaccine_id', $PCV);
            })
            ->whereHas('infant', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();

        return view('site.client.pcvvoucher', compact('PCVs'));
    }

    public function voucher_rewards_view_ipv()
    {
        $current_user = auth()->user();
        $id = $current_user->id;
        $IPV = VaccinesEnum::IPV;

        // ipv
        $IPVs = Voucher::where('is_reedeemable', 1)
            ->whereHas('voucherType', function ($query) use ($IPV) {
                $query->where('vaccine_id', $IPV);
            })
            ->whereHas('infant', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();

        return view('site.client.ipvvoucher', compact('IPVs'));
    }

    public function voucher_rewards_view_opv()
    {
        $current_user = auth()->user();
        $id = $current_user->id;
        $OPV = VaccinesEnum::OPV;

        // opv
        $OPVs = Voucher::where('is_reedeemable', 1)
            ->whereHas('voucherType', function ($query) use ($OPV) {
                $query->where('vaccine_id', $OPV);
            })
            ->whereHas('infant', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();


        return view('site.client.opvvoucher', compact('OPVs'));
    }

    public function voucher_rewards_view_penta()
    {
        $current_user = auth()->user();
        $id = $current_user->id;

        $PENTAVALENT = VaccinesEnum::PENTAVALENT;

        // pentavalent
        $PENTAVALENTs = Voucher::where('is_reedeemable', 1)
            ->whereHas('voucherType', function ($query) use ($PENTAVALENT) {
                $query->where('vaccine_id', $PENTAVALENT);
            })
            ->whereHas('infant', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();


        return view('site.client.pentavoucher', compact('PENTAVALENTs'));
    }

    public function voucher_rewards_view_hepb()
    {
        $current_user = auth()->user();
        $id = $current_user->id;

        $HEPATITIS_B = VaccinesEnum::HEPATITIS_B;

        // hepb
        $HEPATITIS_Bs = Voucher::where('is_reedeemable', 1)
            ->whereHas('voucherType', function ($query) use ($HEPATITIS_B) {
                $query->where('vaccine_id', $HEPATITIS_B);
            })
            ->whereHas('infant', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();

        return view('site.client.hepbvoucher', compact('HEPATITIS_Bs'));
    }

    public function my_vouchers_view()
    {
        $current_user = auth()->user();
        $id = $current_user->id;

        $my_vouchers = Voucher::where('is_redeemed', 1)
            ->whereHas('infant', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->get();

        return view('site.client.myvouchers', compact('my_vouchers'));
    }

    public function edit_infant_view($id)
    {
        $infant = Infant::where('id', $id)->first();
        return view('site.client.edit_infant', compact('infant'));
    }

    public function edit_infant(Request $request)
    {
        $current_user = auth()->user();
        $id = $current_user->id;

        $infant = Infant::where('id', $request->id)->first();

        $parent = User::where('id', $id)->first();



        try {
            // check the password if its correct
            if (!(Hash::check($request->password, $parent->password))) {
                return redirect()->back()->with('password_error', 'error password');
            } else {
                DB::beginTransaction();
                $infant->infant_firstname = $request->infant_firstname;
                $infant->infant_middlename = $request->infant_middlename;
                $infant->infant_lastname = $request->infant_lastname;
                $infant->date_of_birth = $request->date_of_birth;
                $infant->place_of_birth = $request->place_of_birth;
                $infant->sex = $request->sex;
                $infant->address = $request->address;
                $infant->father_firstname = $request->father_firstname;
                $infant->father_middlename = $request->father_middlename;
                $infant->father_lastname = $request->father_lastname;
                $infant->mother_firstname = $request->mother_firstname;
                $infant->mother_middlename = $request->mother_middlename;
                $infant->mother_lastname = $request->mother_lastname;
                $infant->save();
                DB::commit();
            }

            return redirect("/parent/infant/$infant->id}")->with('edit_success', 'asdasd');

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function vaccine_description_view()
    {
        $vaccines = Vaccine::all();
        return view('site.client.vaccine', compact('vaccines'));
    }

    public function editProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'userid' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'address' => 'required',
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $validated = $validator->validate();

        try {
            // find and update the user
            $user = User::find($validated['userid']);
            $user->first_name = $validated['firstname'];
            $user->last_name = $validated['lastname'];
            $user->middle_name = $validated['middlename'];
            $user->email = $validated['email'];
            $user->phone_number = $validated['phonenumber'];
            $user->address = $validated['address'];
            $user->username = $validated['username'];
            $user->save();

            return redirect()->back()->with('editprofilesuccess', 'Profile updated successfully');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function updatepassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userid' => 'required',
            'password' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $validated = $validator->validate();

        try {
            $user = User::find($validated['userid']);
            if (password_verify($validated['password'], $user->password)) {
                if ($validated['newpassword'] == $validated['confirmpassword']) {
                    $user->password = bcrypt($validated['newpassword']);
                    $user->save();
                    return redirect()->back()->with('passwordchangesuccess', 'Password changed successfully');
                } else {
                    return redirect()->back()->with('passwordchangefailnotmatched', 'New password and confirm password do not match');
                }
            } else {
                return redirect()->back()->with('passwordchangefail', 'Old password is incorrect');
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}


