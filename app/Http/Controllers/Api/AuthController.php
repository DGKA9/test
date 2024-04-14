<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Services\Auth\CreateRefreshToken;
use App\Services\Validator\RegisterValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $registerUserData;
    public function __construct(RegisterValidator $registerUserData)
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'register']]);
        $this->registerUserData = $registerUserData;
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $CreateRefreshToken = new CreateRefreshToken();
        $refreshToken = $CreateRefreshToken->CreateRefreshToken();
        return $this->respondWithToken($token, $refreshToken);
    }
    public function register(Request $request)
    {
        $registerUserData = $this->registerUserData->RegisterValidator($request->all());
        $user = User::create([
            'userID' => Str::uuid(),
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
            'roleID' => $registerUserData['roleID']
        ]);
        return response()->json([
            'message' => 'User Created ',
        ]);
    }
    public function profile()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(auth()->user());
    }
    public function logout()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        auth()->logout();
        return response()->json(['message' => 'Đăng xuất thành công']);
    }

    public function refresh()
    {
        $refreshToken =  request()->refresh_token;
        try {
            $decoded = JWTAuth::getJWTProvider()->decode($refreshToken);

            // xu ly cap lai token moi
            $user = User::find($decoded['sub']);
            if (!$user){
                return response()->json(['error' => "Khong tim thay nguoi dung co ID la $user"], 404);
            }
            $token = auth()->login($user);
            $CreateRefreshToken = new CreateRefreshToken();
            $refresh_token = $CreateRefreshToken->CreateRefreshToken();
            return $this->respondWithToken($token, $refresh_token);
        }catch (JWTException $e){
            return response()->json(['error' => "Refresh Token Invalid"], 401);
        }
    }


    protected function respondWithToken($token, $refreshToken)
    {
        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
             'expires_in' => auth()->factory()->getTTL() * 5
        ]);
    }
}
