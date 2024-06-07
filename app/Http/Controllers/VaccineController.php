<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Schedule;
use DB;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function add_vaccine_view(Request $request)
    {
        $vaccines = Vaccine::all();
        return view('site.admin.vaccine', compact('vaccines'));
    }

    public function add_vaccine(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vaccine_name' => 'required|string|max:255',
            'dose_number' => 'required|integer',
            'description' => 'required|string|max:1000',
        ]);

        // Sanitize the vaccine name to create a valid filename
        $vaccineName = $request->input('vaccine_name');
        $sanitizedVaccineName = Str::slug($vaccineName);

        // Handle the file upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = $sanitizedVaccineName . '.' . $extension;

            // Move the file to the public folder
            $file->move(public_path('vaccine_photos'), $fileName);

            // Set the file path
            $filePath = 'vaccine_photos/' . $fileName;
        }

        // Create a new vaccine record
        $vaccine = new Vaccine();
        $vaccine->name = $vaccineName;
        $vaccine->dose_number = $request->input('dose_number');
        $vaccine->description = $request->input('description');
        $vaccine->protection_from = $request->protection_from;
        $vaccine->when_to_give = $request->when_to_give;
        $vaccine->protection_from_details = $request->protection_from_description;
        $vaccine->dir = $filePath ?? null;
        $vaccine->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Vaccine added successfully!');
    }


    public function getDescription($id)
    {
        $vaccine = Vaccine::find($id);
        if ($vaccine) {
            return response()->json(['description' => $vaccine->description]);
        } else {
            return response()->json(['error' => 'Vaccine not found'], 404);
        }
    }
}
