<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddJsonAcceptHeader
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Adiciona o cabeçalho Accept: application/json
        $response->header('Accept', 'application/json');
        $response->header('Content-Type', 'application/json');

        return $response;
    }
}
