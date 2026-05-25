<?php

namespace App\Core\Middleware;

/**
 * Middleware contract
 */
interface MiddlewareInterface
{
    /**
     * Handle request
     */
    public function handle(
        $request,
        $response
    );
}