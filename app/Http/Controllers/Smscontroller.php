<?php

namespace App\Http\Controllers;

use App\Services\SmsService;
use Illuminate\Http\Request;

class Smscontroller extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendSms($phoneNumber, $message)
    {

        try {
            $result = $this->smsService->sendSms($phoneNumber, $message);
            Log::info("naka abot sa sms");
            return response()->json(['success' => true, 'message' => 'SMS sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
