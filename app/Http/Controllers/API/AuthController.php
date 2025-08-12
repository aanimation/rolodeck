<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;

use App\Http\Traits\HttpResponses;
use App\Constants\AuthConstants as CONS;
use App\Enums\TokenAbility;
use App\Models\User;

class AuthController extends Controller
{
    use HttpResponses;

    // Login and generate a token
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required_without:username|string|email|exists:users,email',
            'password' => 'required|string',
            'remember' => 'nullable|boolean'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error(null, CONS::VALIDATION, 401);
        }

        return $this->__login($user, $request->input('remember', false));
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(null, CONS::LOGOUT);
    }

    function __login($user, bool $remember = false, bool $isCallback = false)
    {
        $now = Carbon::now();

        $sanctumExp = $remember ? 'sanctum.expiration_remember' : 'sanctum.expiration';

        try{
            $expirationDateTime = $now->addMinutes(config($sanctumExp));
            $expirationDateTimeRefreshToken = Carbon::parse($expirationDateTime)->addHours(48);
            
            $newToken = $user->createToken(config('app.name'), [TokenAbility::ACCESS_API->value], expiresAt: $expirationDateTime);
            $newToken2 = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], expiresAt: $expirationDateTimeRefreshToken);

            $token = $newToken->plainTextToken;
            $refreshToken = $newToken2->plainTextToken;
        }catch(Exception $e){
            return $this->error($e->getMessage(), CONS::VALIDATION);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $tokenPrefix = $user->id.'|';

        $data = [
            'token' => explode('|', $token)[1],
            'refresh_token' => explode('|', $refreshToken)[1],
            'expires_at' => $now->addMinutes(config($sanctumExp)),
            'last_login' => $now,
        ];

        $user->touch('last_login');

        if($isCallback) {
            $params = '&expires_at='.$data['expires_at']
                    .'&token='.$data['token']
                    .'&refresh_token='.$data['refresh_token']
                    .'&name='.$data['name']
                    .'&is_new='.$data['is_new']
                    .'&last_login='.$data['last_login'];

            return redirect()->away(config('app.target_app_url').'/authentication/google-callback?'.$params);
        }

        return $this->success($data, CONS::LOGIN);
    }
}