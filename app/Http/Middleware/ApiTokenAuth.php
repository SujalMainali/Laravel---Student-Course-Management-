<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\ApiToken;

class ApiTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bearer = $request->bearerToken();

        if (!$bearer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $hash = hash('sha256', $bearer);

        $token = ApiToken::with('user')->where('token', $hash)->first();

        if (!$token || !$token->isValid()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token -> update(['last_used_at' => now()]);

        $request->setUserResolver(fn () => $token->user); //Makes the user available via $request->user() and auth()->user()
        Auth::setUser($token->user);

        $request->attributes->set('api_token', $token); //attaches the api_token to request object

        return $next($request);
    }
}
