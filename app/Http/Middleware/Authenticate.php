<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $currentMiddleware = $request->route()->middleware();
            if(!empty($currentMiddleware) && in_array('auth:doctor',$currentMiddleware)){
                return route('doctor.login');
            }
            return route('login');
        }
    }
}