<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Auth\LoginAuthRequest;
use App\Http\Resources\MeResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse | JsonResource
     */
    public function login(LoginAuthRequest $request)
    {
        $credentials = $request->safe()->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return responseMessage( 'Unauthorized', 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return MeResource
     */
    public function me(Request $request)
    {
        return new MeResource($request->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return responseMessage('Successfully logged out');
    }

    /**
     * Refresh a token.
     *
     * @return JsonResource
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResource
     */
    protected function respondWithToken($token)
    {
        return resourceJson([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
