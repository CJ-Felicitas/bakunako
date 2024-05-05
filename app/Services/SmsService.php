<?php

namespace App\Services;

class SmsService
{
    private $servicePlanId = 'e83586985e474afbb7eaadf8b74027ec';
    private $bearerToken = '464b03a0a45040dfb7e0754139fa4cba';
    private $sendFrom = '+447520651553';

    public function sendSms($phoneNumber, $message)
    {
        // Check if phoneNumber is a string, if so, convert it to an array
        if (!is_array($phoneNumber)) {
            $phoneNumber = explode(',', $phoneNumber);
        }

        // Set necessary fields to be JSON encoded
        $content = [
            'to' => array_values($phoneNumber),
            'from' => $this->sendFrom,
            'body' => $message
        ];

        $data = json_encode($content);

        // Make API call
        $ch = curl_init("https://us.sms.api.sinch.com/xms/v1/{$this->servicePlanId}/batches");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
        curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $this->bearerToken);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }
}
