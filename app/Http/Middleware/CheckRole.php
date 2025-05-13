<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $roleId): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role_id != $roleId) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
} 