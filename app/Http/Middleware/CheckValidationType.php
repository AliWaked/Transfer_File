<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckValidationType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (($request->type == 'email' &&
                ($request->email_to == null || $request->your_email == null)) ||
            ($request->folder == null && $request->file == null)
        ) {
            abort(419);
        }
        return $next($request);
    }
}
