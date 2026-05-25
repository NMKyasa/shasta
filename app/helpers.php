<?php

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