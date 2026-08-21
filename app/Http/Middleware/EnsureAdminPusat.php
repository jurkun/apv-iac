<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdminPusat
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()?->role !== 'admin_pusat') {
            abort(403, 'Hanya admin pusat yang bisa mengakses halaman ini.');
        }

        return $next($request);
    }
}
