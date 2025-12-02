<?php

namespace App\Http\Middleware;

use App\Models\AuthToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $plainToken = session('token');
        if (!$plainToken) {
            return redirect('')->with('expired', 'Token kadaluarsa');
        }

        $hashedToken = hash('sha256', $plainToken);

        $token = AuthToken::where('token', $hashedToken)->first();
        if (!$token) {
            return redirect('')->with('expired', 'Token invalid');
        }

        $request->merge(['auth_user', $token->user]);
        return $next($request);
    }
}
