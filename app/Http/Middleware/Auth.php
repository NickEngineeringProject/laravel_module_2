<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $req
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $req, Closure $next) {
        $token = $req->bearerToken();
        $user = User::where(['api_token' => $token])->first();

        if ($token && $user) {
            $req->user = $user;
            return $next($req);
        }
        else {
            return response()->json([
                'error' => [
                    'code' => '401',
                    'message' => 'Unauthorized'
                ]
            ], 401);
        }
    }
}
