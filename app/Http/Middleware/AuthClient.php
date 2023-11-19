<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AuthClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = User::where('api_token', $request->bearerToken())->firstOrFail();
        } catch (\Exception $errors) {
            $return = (object) array(
                "code" => '401',
                "info" => 'Please login first'
            );

            return response()->json($return);
        }

        auth()->login($user);

        return $next($request);
    }
}