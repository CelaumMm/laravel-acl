<?php

namespace App\Http\Middleware;

use Closure;

class PostMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->is('posts/create')) {
            if (auth()->user()->can('create post')) {
                return $next($request);
            } else {
                abort('403');
            }
        }

        if ($request->is('posts/*/edit')) {
            if (auth()->user()->can('edit post')) {
                return $next($request);
            } else {
                abort('403');
            }
        }

        if ($request->isMethod('Delete')) {
            if (auth()->user()->can('delete post')) {
                return $next($request);
            } else {
                abort('403');
            }
        }

        return $next($request);
    }
}
