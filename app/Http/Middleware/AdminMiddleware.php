<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (!$user instanceof User || !$user->is_admin) {
            abort(403);
        }
        return $next($request);
    }
}
