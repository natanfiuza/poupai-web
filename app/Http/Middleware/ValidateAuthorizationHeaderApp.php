<?php

namespace App\Http\Middleware;

use App\Models\UserActivity;
use App\Models\UserSessionApp;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateAuthorizationHeaderApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $session_invalid = false;

        if (!$request->hasHeader('Authorization')) {
            $session_invalid = true;
            return response()->json([
                'status' => 'error',
                'message' => __('Authorization not found'),
                'auth' => $request->header('Authorization'),
            ], 422);
        }

        if (strpos(" " . $request->header('Authorization'), 'Bearer ') <= 0) {
            $session_invalid = true;
            return response()->json([
                'status' => 'error',
                'message' => __('Authorization format incorrect'),
            ], 422);
        }

        if (!UserSessionApp::is_valid(UserSessionApp::parser_authorization($request->header('Authorization')))) {
            $session_invalid = true;
            return response()->json([
                'status' => 'error',
                'message' => __('User session expired'),
            ], 422);
        }

        $user = UserSessionApp::check(UserSessionApp::parser_authorization($request->header('Authorization')));

        UserActivity::create([
            'user_id' => $user->id,
            'route' => $request->path(),
            'ip' => $request->ip(),
            'is_ajax' => $request->ajax(),
            'method' => $request->method(),
            'accessed_at' => now(),
        ]);

        // if(!$user || $session_invalid === true) {
        //     return redirect()->route('login');
        // }

        return $next($request);
    }
}
