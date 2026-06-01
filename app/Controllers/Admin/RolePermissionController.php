<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Auth\Authorization;
use App\Core\Database\Connection;
use App\Core\Services\Flash;

class RolePermissionController extends BaseController
{
    /**
     * Display roles listing
     */
    public function index(
        $request,
        $response
    )
    {
        /**
         * Authorization
         */
        Authorization::authorize(
            'role_permissions.view'
        );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Get roles with permission counts
         */
        $query =
            $db->query(
                "
                SELECT

                    r.*,

                    COUNT(rp.id)
                    AS permissions_count

                FROM roles r

                LEFT JOIN role_permissions rp

                    ON rp.role_id = r.id

                WHERE r.deleted_at IS NULL

                GROUP BY r.id

                ORDER BY r.name ASC
                "
            );

        $roles =
            $query->fetchAll();

        /**
         * Render view
         */
        return $this->view(

            'admin.role_permissions.index',

            [
                'roles' => $roles
            ],

            'layouts.admin'
        );
    }

    /**
     * Show role permissions form
     */
    public function edit(
        $request,
        $response,
        $id
    )
    {
        /**
         * Authorization
         */
        Authorization::authorize(
            'role_permissions.edit'
        );

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
            $id
        ]);

        $role =
            $query->fetch();

        /**
         * Role not found
         */
        if (
            !$role
        ) {

            Flash::set(
                'danger',
                'Role not found.'
            );

            return $response->redirect(
                url(
                    'dashboard/role_permissions'
                )
            );
        }

        /**
         * Prevent editing Super Admin
         */
        if (

            strtolower(
                $role['name']
            )
            ===
            'super admin'

        ) {

            Flash::set(

                'warning',

                'Super Admin automatically has all permissions.'
            );

            return $response->redirect(
                url(
                    'dashboard/role_permissions'
                )
            );
        }

        /**
         * Get all permissions
         */
        $query =
            $db->query(
                "
                SELECT *
                FROM permissions
                ORDER BY module ASC,
                         action ASC
                "
            );

        $permissions =
            $query->fetchAll();

        /**
         * Get assigned permissions
         */
        $query =
            $db->prepare(
                "
                SELECT permission_id
                FROM role_permissions
                WHERE role_id = ?
                "
            );

        $query->execute([
            $id
        ]);

        $assignedPermissions =
            array_column(
                $query->fetchAll(),
                'permission_id'
            );

        /**
         * Group permissions by module
         */
        $groupedPermissions =
            [];

        foreach (
            $permissions
            as
            $permission
        ) {

            $groupedPermissions[
                $permission['module']
            ][] =
                $permission;
        }

        /**
         * Render view
         */
        return $this->view(

            'admin.role_permissions.edit',

            [

                'role' =>
                    $role,

                'permissions' =>
                    $groupedPermissions,

                'assignedPermissions' =>
                    $assignedPermissions
            ],

            'layouts.admin'
        );
    }

    /**
     * Update role permissions
     */
    public function update(
        $request,
        $response,
        $id
    )
    {
        /**
         * Authorization
         */
        Authorization::authorize(
            'role_permissions.edit'
        );

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
            $id
        ]);

        $role =
            $query->fetch();

        /**
         * Role not found
         */
        if (
            !$role
        ) {

            Flash::set(
                'danger',
                'Role not found.'
            );

            return $response->redirect(
                url(
                    'dashboard/role_permissions'
                )
            );
        }

        /**
         * Prevent editing Super Admin
         */
        if (

            strtolower(
                $role['name']
            )
            ===
            'super admin'

        ) {

            Flash::set(

                'warning',

                'Super Admin automatically has all permissions.'
            );

            return $response->redirect(
                url(
                    'dashboard/role_permissions'
                )
            );
        }

        /**
         * Begin transaction
         */
        $db->beginTransaction();

        try {

            /**
             * Remove existing permissions
             */
            $query =
                $db->prepare(
                    "
                    DELETE
                    FROM role_permissions
                    WHERE role_id = ?
                    "
                );

            $query->execute([
                $id
            ]);

            /**
             * Selected permissions
             */
            $permissions =
                $_POST['permissions']
                ??
                [];

            /**
             * Insert selected permissions
             */
            foreach (
                $permissions
                as
                $permissionId
            ) {

                $query =
                    $db->prepare(
                        "
                        INSERT INTO role_permissions
                        (
                            role_id,
                            permission_id,
                            created_at,
                            updated_at
                        )
                        VALUES
                        (
                            ?, ?, NOW(), NOW()
                        )
                        "
                    );

                $query->execute([

                    $id,

                    $permissionId
                ]);
            }

            /**
             * Commit transaction
             */
            $db->commit();

        } catch (\Exception $e) {

            /**
             * Rollback
             */
            $db->rollBack();

            Flash::set(

                'danger',

                'Failed to save permissions.'
            );

            return $response->redirect(

                url(
                    'dashboard/role_permissions/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Role permissions updated successfully.'
        );

        return $response->redirect(
            url(
                'dashboard/role_permissions'
            )
        );
    }
}