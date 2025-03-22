<?php

namespace App\Helpers;
use Firebase\JWT\JWT;

class AppleSecretKey
{
    static function generateAppleClientSecret()
    {
        $teamId = env('APPLE_TEAM_ID');
        $clientId = env('APPLE_CLIENT_ID');
        $keyId = env('APPLE_KEY_ID');
        $privateKeyPath = base_path('AppleCredentials/Credentials.p8');

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
