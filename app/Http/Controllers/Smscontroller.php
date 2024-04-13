<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Smscontroller extends Controller
{
    public function sendSms()
    {
        $bearer_token = "c9457ea3ba4d42479289eecf235c2d4f";
        $service_plan_id = "c9457ea3ba4d42479289eecf235c2d4f";

        //Any phone number assigned to your API
        $send_from = "447520651752";

        //May be several, separate with a comma ,
        $recipient_phone_numbers = "639650859745";
        $message = "Laravel Windows {$recipient_phone_numbers} from {$send_from}";

        // Check recipient_phone_numbers for multiple numbers and make it an array.
        if (stristr($recipient_phone_numbers, ',')) {
            $recipient_phone_numbers = explode(',', $recipient_phone_numbers);
        } else {
            $recipient_phone_numbers = [$recipient_phone_numbers];
        }

        // Set necessary fields to be JSON encoded
        $content = [
            'to' => array_values($recipient_phone_numbers),
            'from' => $send_from,
            'body' => $message
        ];
        $url = env('SMS_API_URL');
        $data = json_encode($content);

        $ch = curl_init("https://sms.api.sinch.com/xms/v1/c9457ea3ba4d42479289eecf235c2d4f/batches");


        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
        curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $bearer_token);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'Curl error: ' . curl_error($ch);
        } else {
            return $result;
        }


    }
}
