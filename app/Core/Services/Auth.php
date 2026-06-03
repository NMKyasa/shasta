<?php

namespace App\Core\Services;

use App\Core\Database\Connection;
use App\Core\Services\AuditLog;

class Auth
{
    /**
     * Attempt login
     */
    public static function attempt(
        $email,
        $password
    )
    {
        /**
         * Database connection
         */
        $db = Connection::getInstance();

        /**
         * Find user
         */
        $query =
            $db->prepare(
                "
                SELECT *
                FROM users
                WHERE email = ?
                LIMIT 1
                "
            );

        $query->execute([$email]);

        $user = $query->fetch();

        /**
         * User not found
         */
        if (!$user) {

            AuditLog::log(

                'failed_login',

                'authentication',

                null,

                null,

                [
                    'email' => $email
                ],

                'security'
            );

            return false;
        }

        /**
         * Verify password
         */
        if (
            !password_verify(
                $password,
                $user['password']
            )
        ) {
            AuditLog::log(

                'failed_login',

                'authentication',

                $user['id'],

                null,

                [
                    'email' => $email
                ],

                'security'
            );
            return false;
        }

        /**
         * Store user session
         */
        $_SESSION['user'] = $user;

        /**
         * Audit log
         */
        AuditLog::log(

            'login',

            'authentication',

            $user['id'],

            null,

            [
                'email' =>
                    $user['email']
            ],

            'security'
        );

        return true;
    }

    /**
     * Check authentication
     */
    public static function check()
    {
        return isset($_SESSION['user']);
    }

    /**
     * Get current user
     */
    public static function user()
    {
        return $_SESSION['user']
            ??
            null;
    }

    /**
     * Logout user
     */
    public static function logout()
    {
        AuditLog::log(

            'logout',

            'authentication',

            self::id(),

            null,

            null,

            'security'
        );

        unset($_SESSION['user']);
    }

    /**
     * Get user ID
     */
    public static function id()
    {
        return $_SESSION['user']['id']
            ??
            null;
    }
}