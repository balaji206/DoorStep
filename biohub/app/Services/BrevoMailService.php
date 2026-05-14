<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrevoMailService
{
    public static function send($toEmail, $toName, $subject, $htmlContent)
    {
        $response = Http::withHeaders([
            'api-key' => config('services.brevo.key'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [

            'sender' => [
                'name' => env('MAIL_FROM_NAME'),
                'email' => env('MAIL_FROM_ADDRESS'),
            ],

            'to' => [
                [
                    'email' => $toEmail,
                    'name' => $toName,
                ]
            ],

            'subject' => $subject,

            'htmlContent' => $htmlContent,
        ]);
       
return [
    'status' => $response->status(),
    'body' => $response->json(),
];
    }
}