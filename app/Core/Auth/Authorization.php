<?php

namespace App\Core\Auth;

use App\Core\Database\Connection;
use App\Core\Services\Auth;

class Authorization
{
    /**
     * Check permission
     */
    public static function can(
        string $permission
    ): bool
    {
        /**
         * User must be logged in
         */
        if (
            !Auth::check()
        ) {

            return false;
        }

        /**
         * Current user
         */
        $user =
            Auth::user();

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Get role
         */
        $query =
            $db->prepare(
                "
                SELECT *
                FROM roles
                WHERE id = ?
                LIMIT 1
                "
            );

        $query->execute([
            $user['role_id']
        ]);

        $role =
            $query->fetch();

        /**
         * Role not found
         */
        if (
            !$role
        ) {

            return false;
        }

        /**
         * Super Admin bypass
         */
        if (

            strtolower(
                $role['name']
            )

            ===

            'super admin'

        ) {

            return true;
        }

        /**
         * Check user override
         */
        $query =
            $db->prepare(
                "
                SELECT up.allowed

                FROM user_permissions up

                INNER JOIN permissions p

                    ON p.id = up.permission_id

                WHERE up.user_id = ?

                AND p.name = ?

                LIMIT 1
                "
            );

        $query->execute([

            $user['id'],

            $permission
        ]);

        $override =
            $query->fetch();

        /**
         * Explicit user override
         */
        if (
            $override
        ) {

            return (bool)
                $override['allowed'];
        }

        /**
         * Check role permission
         */
        $query =
            $db->prepare(
                "
                SELECT p.id

                FROM role_permissions rp

                INNER JOIN permissions p

                    ON p.id = rp.permission_id

                WHERE rp.role_id = ?

                AND p.name = ?

                LIMIT 1
                "
            );

        $query->execute([

            $user['role_id'],

            $permission
        ]);

        return (bool)
            $query->fetch();
    }

    /**
     * Authorize request
     */
    public static function authorize(
        string $permission
    ): void
    {
        if (
            !self::can(
                $permission
            )
        ) {

            http_response_code(
                403
            );

            die(
                'Access denied.'
            );
        }
    }
}