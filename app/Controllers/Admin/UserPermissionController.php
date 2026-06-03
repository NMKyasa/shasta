<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Auth\Authorization;
use App\Core\Database\Connection;
use App\Core\Services\Auth;
use App\Core\Services\Flash;
use App\Core\Services\AuditLog;

class UserPermissionController extends BaseController
{
    /**
     * Display users listing
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
            'user_permissions.view'
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
            Auth::user();

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
         * Super Admin
         * sees all users
         */
        if (

            strtolower(
                $currentRole['name']
            )

            ===

            'super admin'

        ) {

            $query =
                $db->prepare(
                    "
                    SELECT

                        u.*,

                        r.name
                        AS role_name,

                        COUNT(up.id)
                        AS overrides_count

                    FROM users u

                    INNER JOIN roles r

                        ON r.id = u.role_id

                    LEFT JOIN user_permissions up

                        ON up.user_id = u.id

                    WHERE

                        LOWER(r.name)
                        !=
                        'super admin'

                    AND

                        u.id != ?

                    GROUP BY u.id

                    ORDER BY u.first_name ASC,
                            u.last_name ASC
                    "
                );

            $query->execute([
                $currentUser['id']
            ]);

        } else {

            /**
             * Admin and others
             * cannot see Super Admin
             */
            $query =
                $db->prepare(
                    "
                    SELECT

                        u.*,

                        r.name
                        AS role_name,

                        COUNT(up.id)
                        AS overrides_count

                    FROM users u

                    INNER JOIN roles r

                        ON r.id = u.role_id

                    LEFT JOIN user_permissions up

                        ON up.user_id = u.id

                    WHERE

                        u.id != ?

                    AND

                        LOWER(r.name) != 'super admin'

                    GROUP BY u.id

                    ORDER BY u.first_name ASC,
                            u.last_name ASC
                    "
                );

            $query->execute([
                $currentUser['id']
            ]);
        }

        /**
         * Users
         */
        $users =
            $query->fetchAll();

        /**
         * Render view
         */
        return $this->view(

            'admin.user_permissions.index',

            [
                'users' => $users
            ],

            'layouts.admin'
        );
    }

    /**
     * Show user permissions form
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
            'user_permissions.edit'
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
            Auth::user();

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
         * Get user
         */
        $query =
            $db->prepare(
                "
                SELECT

                    u.*,

                    r.name
                    AS role_name

                FROM users u

                INNER JOIN roles r

                    ON r.id = u.role_id

                WHERE u.id = ?

                LIMIT 1
                "
            );

        $query->execute([
            $id
        ]);

        $user =
            $query->fetch();

            /**
             * Current user
             */
            $currentUser =
                Auth::user();

            /**
             * Prevent users from
             * editing their own
             * permissions
             */
            if (

                $user

                &&

                $user['id']

                ==

                $currentUser['id']

            ) {

                Flash::set(

                    'danger',

                    'You cannot modify your own permissions.'
                );

                return $response->redirect(

                    url(
                        'dashboard/user_permissions'
                    )
                );
            }

        /**
         * User not found
         */
        if (
            !$user
        ) {

            Flash::set(
                'danger',
                'User not found.'
            );

            return $response->redirect(
                url(
                    'dashboard/user_permissions'
                )
            );
        }

        /**
         * Super Admin
         * cannot be managed
         */
        if (

            strtolower(
                $user['role_name']
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
                    'dashboard/user_permissions'
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
             * may only manage permissions
             * they already possess.
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
         * Role permissions
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
            $user['role_id']
        ]);

        $rolePermissions =
            array_column(
                $query->fetchAll(),
                'permission_id'
            );

        /**
         * User overrides
         */
        $query =
            $db->prepare(
                "
                SELECT

                    permission_id,

                    allowed

                FROM user_permissions

                WHERE user_id = ?
                "
            );

        $query->execute([
            $id
        ]);

        $overrides =
            [];

        foreach (
            $query->fetchAll()
            as
            $override
        ) {

            $overrides[
                $override['permission_id']
            ] =
                $override['allowed'];
        }

        /**
         * Group permissions
         */
        $groupedPermissions =
            [];

        foreach (
            $permissions
            as
            $permission
        ) {

            /**
             * Determine state
             *
             * allow
             * deny
             * inherit
             */
            $permission['state'] =
                'inherit';

            if (

                isset(

                    $overrides[
                        $permission['id']
                    ]

                )

            ) {

                $permission['state'] =
                    $overrides[
                        $permission['id']
                    ]
                    ?
                    'allow'
                    :
                    'deny';
            }

            /**
             * Role inherited access
             */
            $permission['role_allowed'] =
                in_array(

                    $permission['id'],

                    $rolePermissions
                );

            $groupedPermissions[
                $permission['module']
            ][] =
                $permission;
        }

        /**
         * Render view
         */
        return $this->view(

            'admin.user_permissions.edit',

            [

                'user' =>
                    $user,

                'permissions' =>
                    $groupedPermissions

            ],

            'layouts.admin'
        );
    }

        /**
     * Update user permissions
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
            'user_permissions.edit'
        );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Get user
         */
        $query =
            $db->prepare(
                "
                SELECT

                    u.*,

                    r.name
                    AS role_name

                FROM users u

                INNER JOIN roles r

                    ON r.id = u.role_id

                WHERE u.id = ?

                LIMIT 1
                "
            );

        $query->execute([
            $id
        ]);

        $user =
            $query->fetch();

            /**
         * Current user
         */
        $currentUser =
            Auth::user();

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
         * Prevent users from
         * modifying their own
         * permissions
         */
        if (

            $user

            &&

            $user['id']

            ==

            $currentUser['id']

        ) {

            Flash::set(

                'danger',

                'You cannot modify your own permissions.'
            );

            return $response->redirect(

                url(
                    'dashboard/user_permissions'
                )
            );
        }

        /**
         * User not found
         */
        if (
            !$user
        ) {

            Flash::set(

                'danger',

                'User not found.'
            );

            return $response->redirect(

                url(
                    'dashboard/user_permissions'
                )
            );
        }

        /**
         * Super Admin protection
         */
        if (

            strtolower(
                $user['role_name']
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
                    'dashboard/user_permissions'
                )
            );
        }

        /**
         * Get role permissions
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
            $user['role_id']
        ]);

        $rolePermissions =
            array_column(

                $query->fetchAll(),

                'permission_id'
            );

            /**
             * Existing user overrides
             */
            $query =
                $db->prepare(
                    "
                    SELECT
                        permission_id,
                        allowed
                    FROM user_permissions
                    WHERE user_id = ?
                    "
                );

            $query->execute([
                $id
            ]);

            $oldOverrides =
                $query->fetchAll();

        /**
         * Submitted states
         */
        $submittedPermissions =
            $_POST['permissions']
            ??
            [];

        /**
         * Begin transaction
         */
        $db->beginTransaction();

        try {

            /**
             * Remove existing overrides
             */
            $query =
                $db->prepare(
                    "
                    DELETE
                    FROM user_permissions
                    WHERE user_id = ?
                    "
                );

            $query->execute([
                $id
            ]);

            /**
             * Process permissions
             */
            foreach (

                $submittedPermissions
                as
                $permissionId => $state

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
                 * Invalid permission
                 */
                if (
                    !$permission
                ) {

                    continue;
                }

                /**
                 * Non-super-admin users
                 * may only assign permissions
                 * they already possess.
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
                 * Role permission?
                 */
                $roleAllowed =
                    in_array(

                        $permissionId,

                        $rolePermissions
                    );

                /**
                 * Inherit
                 *
                 * No override stored
                 */
                if (
                    $state
                    ===
                    'inherit'
                ) {

                    continue;
                }

                /**
                 * Allow
                 */
                if (
                    $state
                    ===
                    'allow'
                ) {

                    /**
                     * If role already allows,
                     * no override needed.
                     */
                    if (
                        $roleAllowed
                    ) {

                        continue;
                    }

                    $allowed = 1;
                }

                /**
                 * Deny
                 */
                elseif (
                    $state
                    ===
                    'deny'
                ) {

                    /**
                     * If role already denies,
                     * no override needed.
                     */
                    if (
                        !$roleAllowed
                    ) {

                        continue;
                    }

                    $allowed = 0;
                }

                /**
                 * Invalid state
                 */
                else {

                    continue;
                }

                /**
                 * Insert override
                 */
                $query =
                    $db->prepare(
                        "
                        INSERT INTO user_permissions
                        (
                            user_id,
                            permission_id,
                            allowed,
                            created_at,
                            updated_at
                        )
                        VALUES
                        (
                            ?, ?, ?, NOW(), NOW()
                        )
                        "
                    );

                $query->execute([

                    $id,

                    $permissionId,

                    $allowed
                ]);
            }

            /**
             * Commit transaction
             */
            $db->commit();

            /**
             * New user overrides
             */
            $query =
            $db->prepare(
                "
                SELECT

                    p.name,

                    up.allowed

                FROM user_permissions up

                INNER JOIN permissions p

                    ON p.id = up.permission_id

                WHERE up.user_id = ?
                "
            );

            $query->execute([
                $id
            ]);

            $newOverrides =
                $query->fetchAll();


                if (

                    json_encode($oldOverrides)

                    !=

                    json_encode($newOverrides)

                ) {

                    AuditLog::log(

                        'permission_override_changed',

                        'user_permissions',

                        $id,

                        $oldOverrides,

                        $newOverrides,

                        'security'
                    );
                }

            /**
             * Audit log
             */
            AuditLog::log(

                'permissions_updated',

                'user_permissions',

                $id,

                [

                    'user_id' =>
                        $id,

                    'overrides' =>
                        $oldOverrides

                ],

                [

                    'user_id' =>
                        $id,

                    'overrides' =>
                        $newOverrides

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

                'Failed to save user permissions.'
            );

            return $response->redirect(

                url(
                    'dashboard/user_permissions/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Success
         */
        Flash::set(

            'success',

            'User permissions updated successfully.'
        );

        return $response->redirect(

            url(
                'dashboard/user_permissions'
            )
        );
    }
}