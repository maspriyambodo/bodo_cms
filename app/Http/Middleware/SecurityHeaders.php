<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders {

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin');
        $response->headers->set('Permissions-Policy', 'accelerometer=(self),autoplay=(self),camera=(self),geolocation=(self),microphone=(self),payment=(self),sync-xhr=(self)'); //fullscreen 'none',microphone 'none',accelerometer=(self),autoplay=(self),camera=(self),geolocation=(self),microphone=(self),payment=(self),sync-xhr=(self)
        return $response;
    }
}
