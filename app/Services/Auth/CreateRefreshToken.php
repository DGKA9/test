<?php

namespace App\Services\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;

class CreateRefreshToken
{
    public function __construct()
    {

    }
    public function CreateRefreshToken()
    {
        $data = [
            'sub' => auth()->user()->userID,
            'random' => rand() . time(),
            'exp' => time() + config('JWT_REFRESH_TTL')
        ];

        $refreshToken = JWTAuth::getJWTProvider()->encode($data);
        return $refreshToken;
    }
}
