<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;
use App\Models\Infant;

class ParentController extends Controller
{
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
            $infant = Infant::findOrFail($id);
            return view('site.client.infantinfo', compact('infant'));
        } catch (ModelNotFoundException $e) {
            return redirect('/parent/dashboard')->with('error', 'Infant not found');
        }
    }

    // store the infant details
    public function store(Request $request)
    {
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
            'mother_lastname' => 'required',
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

            return redirect('/parent/dashboard')->with('success', 'Infant added successfully');

        } catch (\Throwable $th) {
            return $th;
        }
    }
}