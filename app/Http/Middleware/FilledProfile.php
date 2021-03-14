<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

class FilledProfile
{
    public function handle($request, \Closure $next)
    {
        $user = Auth::user();

        if (!$user->hasFilledProfile()) {
            return redirect()
                ->route('cabinet.home')
                ->with('error', 'Please fill your profile.');
        }

        return $next($request);
    }
}
