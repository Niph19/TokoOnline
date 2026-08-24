<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class cekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = $request->Auth::class('role');
        if (!$request->has('role') || $role === 'admin') {

            return redirect('/dashboard-admin')->with(403, 'akses ditolak.');
        }
        return $next($request);
    }
}
