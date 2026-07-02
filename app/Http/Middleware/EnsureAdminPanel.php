<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdminPanel
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()?->is_admin) {
            return redirect()->route('student.dashboard');
        }

        return $next($request);
    }
}
