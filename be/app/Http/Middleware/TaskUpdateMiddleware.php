<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TaskUpdateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route()->parameters['task']->owner?->id === auth()->id() || $request->route(
            )->parameters['task']->assigned?->id === auth()->id()) {
            return $next($request);
        }

        return response()->json(['message' => 'You do not have sufficient rights to edit this issue.'], 400);
    }
}
