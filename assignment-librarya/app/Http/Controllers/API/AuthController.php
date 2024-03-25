<?php

namespace App\Http\Controllers\API;

use DB;
use Validator;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use PHPOpenSourceSaver\JWTAuth\Support\CustomClaims;
use App\Enums\Roles;
use App\Services\FormattedResponsesTrait;
use App\Http\Controllers\Controller;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\API
 */
class AuthController extends Controller
{
    use FormattedResponsesTrait, CustomClaims;

    /** @var bool */
    public $token = true;

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $ttl = config('jwt.ttl');
        $token = JWTAuth::customClaims(['exp' => now()->addMinutes($ttl)->timestamp])
            ->attempt([
                'email' => $request->email,
                'password' => $request->password,
                'role_id' => Roles::REVIEWER
            ]);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();

        if (is_null($user->email_verified_at))
        {
            return response()->json([
                'success' => false,
                'message' => 'Email is not verified yet!'
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $this->defaultOkStatusResponse('User logged out successfully');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    private function handleTokenMissmatch(Request $request)
    {
        if (!$this->token) return $this->login($request);
    }
}
