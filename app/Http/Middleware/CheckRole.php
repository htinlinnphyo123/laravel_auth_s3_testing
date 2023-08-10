<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next,$role): Response
    {
        $roles = [
            'admin' => [0],
            'user' => [1],
            'manager' => [2]
        ];
        if($request->user() && in_array($request->user()->is_admin,$roles[$role])){
            return $next($request);
        }else{
            abort(403,'You are not authorized to enter this page.');
        }
    }
}
