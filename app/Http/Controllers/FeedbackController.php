<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class FeedbackController extends Controller
{
    public function addFeedback(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
    }
}
