<?php

namespace App\Services;

use App\Models\Otp;
use App\Services\IprogSmsService;

class OtpService
{
    public function normalizePhoneNumber(string $phone): string
    {
        $digits = preg_replace('/\D/', '', $phone);

        if (str_starts_with($digits, '0')) {
            $digits = '63' . substr($digits, 1);
        }

        if (!str_starts_with($digits, '63')) {
            $digits = '63' . $digits;
        }

        return $digits;
    }

    public function isValidPhilippineNumber(string $phone): bool
    {
        $normalized = $this->normalizePhoneNumber($phone);
        return preg_match('/^639\d{9}$/', $normalized) === 1;
    }

    public function createOtp(string $phone): Otp
    {
        return Otp::create([
            'phone_number' => $phone,
            'code'         => (string) random_int(100000, 999999),
            'expires_at'   => now()->addMinutes(5),
            'used'         => false,
        ]);
    }

    public function sendOtpSms(IprogSmsService $sms, string $phone, string $code): array
    {
        $message = "Your OTP code is {$code}. It will expire in 5 minutes.";
        return $sms->sendSms($phone, $message);
    }
}
