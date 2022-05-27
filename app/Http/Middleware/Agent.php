<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Agent
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 'agent') {
            return $next($request);
        }

        return redirect()->route('login'); // If user is not agent
    }
}

