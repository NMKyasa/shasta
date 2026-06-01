<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Auth\Authorization;
use App\Core\Database\Connection;
use App\Core\Services\Flash;

class PermissionSeederController extends BaseController
{
    /**
     * Generate system permissions
     */
    public function seed(
        $request,
        $response
    )
    {
        /**
         * Authorization
         */
        Authorization::authorize(
            'permissions.create'
        );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * System modules
         */
        $modules = [

            'services',
            'projects',
            'categories',
            'menus',
            'menu_items',
            'roles',
            'permissions',
            'role_permissions',
            'users',
            'settings',
            'impact',
            'sliders',
            'testimonials',
            'team',
            'partners',
            'inquiries'
        ];

        /**
         * Standard actions
         */
        $actions = [

            'view',
            'create',
            'edit',
            'deactivate'
        ];

        /**
         * Counter
         */
        $created = 0;

        /**
         * Generate permissions
         */
        foreach (
            $modules
            as
            $module
        ) {

            foreach (
                $actions
                as
                $action
            ) {

                /**
                 * Permission name
                 */
                $name =
                    $module
                    .
                    '.'
                    .
                    $action;

                /**
                 * Check existence
                 */
                $query =
                    $db->prepare(
                        "
                        SELECT id
                        FROM permissions
                        WHERE name = ?
                        LIMIT 1
                        "
                    );

                $query->execute([
                    $name
                ]);

                if (
                    $query->fetch()
                ) {

                    continue;
                }

                /**
                 * Insert permission
                 */
                $query =
                    $db->prepare(
                        "
                        INSERT INTO permissions
                        (
                            module,
                            action,
                            name,
                            description,
                            created_at,
                            updated_at
                        )
                        VALUES
                        (
                            ?, ?, ?, ?, NOW(), NOW()
                        )
                        "
                    );

                $query->execute([

                    $module,

                    $action,

                    $name,

                    ucfirst($action)
                    .
                    ' '
                    .
                    ucfirst(
                        str_replace(
                            '_',
                            ' ',
                            $module
                        )
                    )
                ]);

                $created++;
            }
        }

        /**
         * Success message
         */
        Flash::set(

            'success',

            $created
            .
            ' permissions generated successfully.'
        );

        return $response->redirect(
            url(
                'dashboard/permissions'
            )
        );
    }
}