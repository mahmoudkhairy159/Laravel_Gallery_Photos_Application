<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Check if the request expects a JSON response
        if (!$request->expectsJson()) {
            // If the route is part of the website group, redirect to the website login page
            if (Route::is('user.*')) {
                return route('user.login');
            }

            // Add additional fallback logic here if necessary
        }

        // Return null if no condition is met
        return null;
    }
}
