<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Sesuaikan dengan kolom role pada tabel users.
        $roleUser = strtolower(trim((string) $user->role));

        $roles = array_map(
            fn ($role) => strtolower(trim($role)),
            $roles
        );

        if (!in_array($roleUser, $roles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
