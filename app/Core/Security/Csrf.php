<?php

namespace App\Core\Security;

class Csrf
{
    /**
     * Generate token
     */
    public static function token(): string
    {
        if (
            empty(
                $_SESSION['_csrf_token']
            )
        ) {

            $_SESSION['_csrf_token'] =
                bin2hex(
                    random_bytes(32)
                );
        }

        return
            $_SESSION['_csrf_token'];
    }

    /**
     * Verify token
     */
    public static function verify(
        ?string $token
    ): bool
    {
        if (
            empty(
                $_SESSION['_csrf_token']
            )
        ) {

            return false;
        }

        return hash_equals(

            $_SESSION['_csrf_token'],

            $token ?? ''
        );
    }

    /**
     * Regenerate token
     */
    public static function regenerate(): void
    {
        $_SESSION['_csrf_token'] =
            bin2hex(
                random_bytes(32)
            );
    }
}