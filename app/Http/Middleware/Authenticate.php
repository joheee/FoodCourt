<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('tenant/*')) {
                return route('tenant.login'); // Redirect tenant to their login route
            } elseif ($request->is('superuser/*')) {
                return route('superuser.login'); // Redirect superuser to their login route
            } else {
                return route('login'); // Redirect regular user to the login route
            }
        }
    }
}
