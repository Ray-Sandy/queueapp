<?php

// app/Http/Middleware/CheckQueueSession.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckQueueSession
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('queue')) {
            return $next($request);
        }

        return redirect('/');
    }
}

