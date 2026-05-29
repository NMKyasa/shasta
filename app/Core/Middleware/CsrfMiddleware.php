<?php

namespace App\Core\Middleware;

class CsrfMiddleware
{
    public function handle()
    {
        /**
         * Ignore GET requests
         */
        if (

            $_SERVER['REQUEST_METHOD']
            ===
            'GET'

        ) {

            return;
        }

        verify_csrf();
    }
}