<?php

namespace App\Core\Middleware;

class AuthMiddleware
implements MiddlewareInterface
{
    /**
     * Handle middleware
     */
    public function handle(
        $request,
        $response
    )
    {
        /**
         * Check login session
         */
        if (
            !isset($_SESSION['user'])
        ) {

            /**
             * Redirect guest
             */
            return $response->redirect(
                url('login')
            );
        }
    }
}