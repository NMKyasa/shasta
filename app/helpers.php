<?php

use App\Core\Security\Csrf;

/**
 * Get CSRF token
 */
function csrf_token(): string
{
    return Csrf::token();
}


/**
 * Verify CSRF request
 */
function verify_csrf(): void
{
    $token =
        $_POST['_token']
        ??
        '';

    if (
        !Csrf::verify(
            $token
        )
    ) {

        http_response_code(
            419
        );

        die(
            'CSRF token mismatch.'
        );
    }
}

/**
 * Generate asset URL
 */
function asset($path)
{
    return '/shasta/public/' . ltrim($path, '/');
}

/**
 * Generate URL
 */
function url($path = '')
{
    return '/shasta/public/' . ltrim($path, '/');
}

/**
 * Resource path helper
 */
function resource_path($path = '')
{
    return __DIR__
        . '/../resources/'
        . ltrim($path, '/');
}