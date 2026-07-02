<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureStudentPanel
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()?->is_admin) {
            return redirect()->route('admin.home');
        }

        return $next($request);
    }
}
