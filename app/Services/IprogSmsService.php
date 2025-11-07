<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class IprogSmsService
{
    protected $client;
    protected $apiToken;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiToken = env('IPROG_SMS_API_TOKEN');
        $this->baseUrl = env('IPROG_SMS_BASE_URL', 'https://sms.iprogtech.com/api/v1/sms_messages');
    }

    public function sendSms($phoneNumber, $message)
    {
        $data = [
            'api_token' => $this->apiToken,
            'message' => $message,
            'phone_number' => $phoneNumber,
        ];

        try {
            $response = $this->client->post($this->baseUrl, [
                'form_params' => $data, // Ensure we are sending the parameters in the correct format
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);

            //Log::info('IPROG SMS response body', ['body' => $responseBody]);

            if (
                (isset($responseBody['status']) && (int)$responseBody['status'] === 200) ||
                (isset($responseBody['message']) && stripos($responseBody['message'], 'queued') !== false)
            ) {
                return ['ok' => true, 'body' => $responseBody];
            } else {
                Log::warning('Unexpected SMS response', ['body' => $responseBody]);
                return ['ok' => false, 'body' => $responseBody, 'statusCode' => $response->getStatusCode()];
            }
        } catch (\Exception $e) {
            Log::error('Error sending SMS: ' . $e->getMessage());
            return ['ok' => false, 'body' => $e->getMessage(), 'statusCode' => 500];
        }
    }
}
