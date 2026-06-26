<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasAvatar
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!auth()->user()?->profile?->avatar) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please upload your avatar before creating a post.');
        }

        return $next($request);
    }
}
