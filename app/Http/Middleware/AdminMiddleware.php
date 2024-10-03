<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth() -> user();

        if(!$user || !$user -> is_admin) {
            return redirect('/home');
        }
        return $next($request);
    }
}
