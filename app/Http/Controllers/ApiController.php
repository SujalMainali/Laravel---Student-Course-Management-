<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\ApiToken;

class ApiController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) { 
            // Authentication failed
            return response()->json([
                'message' => 'Invalid credentials'
                ], 401);
        }

        $rawToken = Str::random(64);

        $token = ApiToken::create([
            'user_id' => $user->id,
            'name' => $credentials['name'] ?? 'api-client',
            'token' => hash('sha256', $rawToken),
        ]);

        return response()->json([
            'message' => 'Login successful.',
            'token_type' => 'Bearer',
            'access_token' => $rawToken,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role ?? null,
            ],
        ], 200);
    }
}
