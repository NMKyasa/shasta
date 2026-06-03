<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Auth\Authorization;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Services\Auth;
use App\Core\Services\AuditLog;

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
         * Current user
         */
        $currentUser =
            \App\Core\Services\Auth::user();

        /**
         * Current role
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
            $currentUser['role_id']
        ]);

        $currentRole =
            $query->fetch();

        /**
         * Get roles with permission counts
         */
                if (

            strtolower(
                $currentRole['name']
            )

            ===

            'super admin'

        ) {

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

        } else {

            $query =
                $db->prepare(
                    "
                    SELECT

                        r.*,

                        COUNT(rp.id)
                        AS permissions_count

                    FROM roles r

                    LEFT JOIN role_permissions rp

                        ON rp.role_id = r.id

                    WHERE r.deleted_at IS NULL

                    AND LOWER(r.name) != 'super admin'

                    AND r.id != ?

                    GROUP BY r.id

                    ORDER BY r.name ASC
                    "
                );

            $query->execute([
                $currentRole['id']
            ]);

        }

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
         * Current user
         */
        $currentUser =
            \App\Core\Services\Auth::user();

        /**
         * Current role
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
            $currentUser['role_id']
        ]);

        $currentRole =
            $query->fetch();

            /**
             * Users cannot modify
             * permissions of their
             * own role.
             */
            if (

                $role

                &&

                $role['id']

                ==

                $currentRole['id']

            ) {

                Flash::set(

                    'danger',

                    'You cannot modify permissions of your own role.'
                );

                return $response->redirect(

                    url(
                        'dashboard/role_permissions'
                    )
                );
            }

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
         * Non-super-admin users
         * cannot access Super Admin role
         */
        if (

            strtolower(
                $role['name']
            )

            ===

            'super admin'

            &&

            strtolower(
                $currentRole['name']
            )

            !==

            'super admin'

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
             * Non-super-admin users
             * should only see permissions
             * they already possess
             */
            if (

                strtolower(
                    $currentRole['name']
                )

                !==

                'super admin'

            ) {

                $filteredPermissions =
                    [];

                foreach (
                    $permissions
                    as
                    $permission
                ) {

                    if (

                        Authorization::can(
                            $permission['name']
                        )

                    ) {

                        $filteredPermissions[] =
                            $permission;
                    }
                }

                $permissions =
                    $filteredPermissions;
            }

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

        
        // Current user and role
        $currentUser =
            \App\Core\Services\Auth::user();

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
            $currentUser['role_id']
        ]);

        $currentRole =
            $query->fetch();

            /**
         * Users cannot modify
         * permissions of their
         * own role.
         */
        if (

            $role

            &&

            $role['id']

            ==

            $currentRole['id']

        ) {

            Flash::set(

                'danger',

                'You cannot modify permissions of your own role.'
            );

            return $response->redirect(

                url(
                    'dashboard/role_permissions'
                )
            );
        }

        /**
         * Non-super-admin users
         */
        if (

            strtolower(
                $role['name']
            )

            ===

            'super admin'

            &&

            strtolower(
                $currentRole['name']
            )

            !==

            'super admin'

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
         * Existing permissions
         */
        $oldPermissionsQuery =
            $db->prepare(
                "
                SELECT permission_id
                FROM role_permissions
                WHERE role_id = ?
                "
            );

        $oldPermissionsQuery->execute([
            $id
        ]);

        $oldPermissions =
            array_column(
                $oldPermissionsQuery->fetchAll(),
                'permission_id'
            );

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
            /**
             * Assign permissions
             */
            foreach (
                $permissions
                as
                $permissionId
            ) {

                /**
                 * Get permission
                 */
                $query =
                    $db->prepare(
                        "
                        SELECT *
                        FROM permissions
                        WHERE id = ?
                        LIMIT 1
                        "
                    );

                $query->execute([
                    $permissionId
                ]);

                $permission =
                    $query->fetch();

                /**
                 * Permission not found
                 */
                if (
                    !$permission
                ) {

                    continue;
                }

                /**
                 * Non-super-admin users
                 * may only assign permissions
                 * they already possess
                 */
                if (

                    strtolower(
                        $currentRole['name']
                    )

                    !==

                    'super admin'

                    &&

                    !Authorization::can(
                        $permission['name']
                    )

                ) {

                    continue;
                }

                /**
                 * Save permission
                 */
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

            /**
             * Audit log
             */
            AuditLog::log(

                'permissions_updated',

                'role_permissions',

                $id,

                [

                    'role_name' =>
                        $role['name'],

                    'permissions' =>
                        $oldPermissions

                ],

                [

                    'role_name' =>
                        $role['name'],

                    'permissions' =>
                        $newPermissions

                ],

                'security'
            );

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