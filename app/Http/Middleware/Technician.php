<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Technician
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 'technician') {
            return $next($request);
        }

        return redirect()->route('login'); // If user is not agent
    }
}

