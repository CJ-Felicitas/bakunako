<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Feedback;
use DB;
use Carbon\Carbon;

class FeedbackController extends Controller
{

    // for client
    public function addFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feedback_message' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }
        $validated = $validator->validated();

        try {

            // save the feedback
            DB::beginTransaction();
            $feedback = new Feedback();
            $feedback->first_name = $validated['first_name'];
            $feedback->middle_name = $validated['middle_name'];
            $feedback->last_name = $validated['last_name'];
            $feedback->email = $validated['email'];
            $feedback->user_id = auth()->user()->id;
            $feedback->messaage = $validated['feedback_message'];
            $feedback->created_at = Carbon::now();
            $feedback->updated_at = Carbon::now();
            $feedback->save();
            DB::commit();

            return redirect('/parent/feedback')->with('success', 'Feedback saved successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save feedback',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    // hp
    public function addFeedbackhp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feedback_message' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }
        $validated = $validator->validated();

        try {

            // save the feedback
            DB::beginTransaction();
            $feedback = new Feedback();
            $feedback->first_name = $validated['first_name'];
            $feedback->middle_name = $validated['middle_name'];
            $feedback->last_name = $validated['last_name'];
            $feedback->email = $validated['email'];
            $feedback->user_id = auth()->user()->id;
            $feedback->messaage = $validated['feedback_message'];
            $feedback->created_at = Carbon::now();
            $feedback->updated_at = Carbon::now();
            $feedback->save();
            DB::commit();

            return redirect('/healthcare_provider/feedback')->with('success', 'Feedback saved successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save feedback',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function view()
    {

        return view('site.client.feedback');
    }

    public function hpview(){
        return view('site.healthcare_provider.feedback');
    }
}
