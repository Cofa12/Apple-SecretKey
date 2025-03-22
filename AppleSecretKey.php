<?php

namespace App\Helpers;
use Firebase\JWT\JWT;

class AppleSecretKey
{
    static function generateAppleClientSecret():String
    {
        $teamId = env('APPLE_TEAM_ID');
        $clientId = env('APPLE_CLIENT_ID');
        $keyId = env('APPLE_KEY_ID');
        $privateKeyPath = "PATH OF .p8 file ";

        $privateKey = file_get_contents($privateKeyPath);

        $now = time();
        $payload = [
            'iss' => $teamId,
            'iat' => $now,
            'exp' => $now + 3600 * 6, // 6 hours expiration
            'aud' => 'https://appleid.apple.com',
            'sub' => $clientId,
        ];

        return JWT::encode($payload, $privateKey, 'ES256', $keyId);
    }
}
