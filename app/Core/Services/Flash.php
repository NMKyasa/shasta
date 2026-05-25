<?php

namespace App\Core\Services;

class Flash
{
    /**
     * Set flash message
     */
    public static function set(
        $type,
        $message
    )
    {
        $_SESSION['flash'] = [

            'type' =>
                $type,

            'message' =>
                $message
        ];
    }

    /**
     * Get flash message
     */
    public static function get()
    {
        if (
            !isset($_SESSION['flash'])
        ) {

            return null;
        }

        $flash =
            $_SESSION['flash'];

        /**
         * Remove after reading
         */
        unset($_SESSION['flash']);

        return $flash;
    }
}