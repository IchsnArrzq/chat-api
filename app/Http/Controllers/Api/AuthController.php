<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\JsonRespond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends ApiController
{
    use JsonRespond;
    /**
     * Register a new user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return $this->respond([
            'user' => $user,
            'access_token' => $token,
        ]);
    }

    /**
     * Authenticate a user and return a token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password',
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('api_token')->plainTextToken;

        return $this->respond([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Log out the authenticated user and revoke their tokens.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->respond([
            'message' => 'Logged out successfully',
        ]);
    }
}
