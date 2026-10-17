<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckVaiTro
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
        if (!$user) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthenticated'], 401)
                : redirect()->route('login');
        }

        if (!in_array($user->role, $roles, true)) {
            abort(403, 'Bạn không có quyền thực hiện chức năng này.');
        }

        return $next($request);
    }
}
