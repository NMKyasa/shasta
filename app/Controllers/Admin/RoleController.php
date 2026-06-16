<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Services\Auth;
use App\Core\Validation\Validator;
use App\Core\Auth\Authorization;
use App\Core\Services\AuditLog;

class RoleController extends BaseController
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
            'roles.view'
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
         * Get roles
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
                        parent.name AS parent_role

                    FROM roles r

                    LEFT JOIN roles parent
                        ON parent.id = r.parent_role_id

                    WHERE r.deleted_at IS NULL

                    ORDER BY r.name ASC
                    "
                );

        } else {

            $query =
                $db->query(
                    "
                    SELECT
                        r.*,
                        parent.name AS parent_role

                    FROM roles r

                    LEFT JOIN roles parent
                        ON parent.id = r.parent_role_id

                    WHERE r.deleted_at IS NULL

                    AND LOWER(r.name) != 'super admin'

                    ORDER BY r.name ASC
                    "
                );

        }

        $roles =
            $query->fetchAll();

        /**
         * Render view
         */
        return $this->view(

            'admin.roles.index',

            [
                'roles' => $roles
            ],

            'layouts.admin'
        );
    }

    /**
     * Show create form
     */
    public function create(
        $request,
        $response
    )
    {
        /**
         * Authorization
         */
        Authorization::authorize(
            'roles.create'
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
         * Parent roles
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
                    SELECT *
                    FROM roles
                    WHERE deleted_at IS NULL
                    ORDER BY name ASC
                    "
                );

        } else {

            $query =
                $db->query(
                    "
                    SELECT *
                    FROM roles
                    WHERE deleted_at IS NULL
                    AND LOWER(name) != 'super admin'
                    ORDER BY name ASC
                    "
                );

        }

        $roles =
            $query->fetchAll();

        /**
         * Render view
         */
        return $this->view(

            'admin.roles.create',

            [
                'roles' => $roles,
                'currentRole' => $currentRole
            ],

            'layouts.admin'
        );
    }

    /**
     * Store role
     */
    public function store(
        $request,
        $response
    )
    {
        /**
         * Authorization
         */
        Authorization::authorize(
            'roles.create'
        );

        /**
         * Validate request
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'name' =>
                        'required|max:255',

                    'status' =>
                        'required|in:active,inactive',

                    'is_system' =>
                        'required|boolean'
                ]
            );

        /**
         * Validation failed
         */
        if (
            $validator->fails()
        ) {

            Flash::set(

                'danger',

                implode(
                    '<br>',
                    $validator->all()
                )
            );

            return $response->redirect(

                url(
                    'dashboard/roles/create'
                )
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Role name
         */
        $name =
            trim(
                $_POST['name']
            );

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
             * Prevent creation
             * of Super Admin role
             */
            if (

                strtolower($name)
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

                    'Role name already exists.'
                );

                return $response->redirect(

                    url(
                        'dashboard/roles/create'
                    )
                );
            }

        /**
         * Check duplicate role
         */
        $query =
            $db->prepare(
                "
                SELECT id
                FROM roles
                WHERE name = ?
                AND deleted_at IS NULL
                LIMIT 1
                "
            );

        $query->execute([
            $name
        ]);

        if (
            $query->fetch()
        ) {

            Flash::set(

                'danger',

                'Role name already exists.'
            );

            return $response->redirect(

                url(
                    'dashboard/roles/create'
                )
            );
        }

        /**
         * Parent role
         */
        $parentRoleId =
            !empty(
                $_POST['parent_role_id']
            )
            ?
            $_POST['parent_role_id']
            :
            null;

            /**
         * Prevent non-super-admins
         * from assigning Super Admin
         */
        if (

            strtolower(
                $currentRole['name']
            ) !== 'super admin'

            &&

            !empty($parentRoleId)

        ) {

            $query =
                $db->prepare(
                    "
                    SELECT name
                    FROM roles
                    WHERE id = ?
                    LIMIT 1
                    "
                );

            $query->execute([
                $parentRoleId
            ]);

            $parentRole =
                $query->fetch();

            if (

                $parentRole

                &&

                strtolower(
                    $parentRole['name']
                ) === 'super admin'

            ) {

                Flash::set(
                    'danger',
                    'You cannot assign Super Admin as a parent role.'
                );

                return $response->redirect(
                    url('dashboard/roles/create')
                );
            }
        }

        /**
         * Description
         */
        $description =
            trim(
                $_POST['description']
                ??
                ''
            );

        /**
         * System role
         */
        $isSystem =
            $_POST['is_system']
            ??
            0;

        /**
         * Status
         */
        $status =
            $_POST['status'];

        /**
         * Insert role
         */
        $query =
            $db->prepare(
                "
                INSERT INTO roles
                (
                    parent_role_id,
                    name,
                    description,
                    is_system,
                    status,
                    created_at,
                    updated_at
                )
                VALUES
                (
                    ?, ?, ?, ?, ?, NOW(), NOW()
                )
                "
            );

        $query->execute([

            $parentRoleId,

            $name,

            $description,

            $isSystem,

            $status
        ]);

        /**
         * Audit log
         */
        AuditLog::log(

            'create',

            'roles',

            $db->lastInsertId(),

            null,

            [

                'parent_role_id' =>
                    $parentRoleId,

                'name' =>
                    $name,

                'description' =>
                    $description,

                'is_system' =>
                    $isSystem,

                'status' =>
                    $status

            ]
        );

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Role created successfully.'
        );

        return $response->redirect(

            url(
                'dashboard/roles'
            )
        );
    }

    /**
     * Show edit form
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
            'roles.edit'
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
             * Find role being edited
             */
            $query =
                $db->prepare(
                    "
                    SELECT *
                    FROM roles
                    WHERE id = ?
                    AND deleted_at IS NULL
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
                    'dashboard/roles'
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
                    'dashboard/roles'
                )
            );
        }

        /**
         * Parent roles
         */
        if (
            strtolower(
                $currentRole['name']
            ) === 'super admin'
        ) {

            $query =
                $db->prepare(
                    "
                    SELECT *
                    FROM roles
                    WHERE id != ?
                    AND deleted_at IS NULL
                    ORDER BY name ASC
                    "
                );

        } else {

            $query =
                $db->prepare(
                    "
                    SELECT *
                    FROM roles
                    WHERE id != ?
                    AND deleted_at IS NULL
                    AND LOWER(name) != 'super admin'
                    ORDER BY name ASC
                    "
                );
        }

        $query->execute([
            $id
        ]);

        $roles =
            $query->fetchAll();

        /**
         * Render view
         */
        return $this->view(

            'admin.roles.edit',

            [

                'role' => $role,

                'roles' => $roles, 

                'currentRole' => $currentRole
            ],

            'layouts.admin'
        );
    }

    /**
     * Update role
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
            'roles.edit'
        );

        /**
         * Validate request
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'name' =>
                        'required|max:255',

                    'status' =>
                        'required|in:active,inactive',

                    'is_system' =>
                        'required|boolean'
                ]
            );

        /**
         * Validation failed
         */
        if (
            $validator->fails()
        ) {

            Flash::set(

                'danger',

                implode(
                    '<br>',
                    $validator->all()
                )
            );

            return $response->redirect(

                url(
                    'dashboard/roles/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

            /**
             * Existing role
             */
            $existingRoleQuery =
                $db->prepare(
                    "
                    SELECT *
                    FROM roles
                    WHERE id = ?
                    LIMIT 1
                    "
                );

            $existingRoleQuery->execute([
                $id
            ]);

            $oldRole =
                $existingRoleQuery->fetch();


            // New Parent ROle ID
            $newParentRoleId =
                !empty(
                    $_POST['parent_role_id']
                )
                ?
                $_POST['parent_role_id']
                :
                null;

                /**
             * Prevent non-super-admins
             * from assigning Super Admin
             */
            if (

                strtolower(
                    $currentRole['name']
                ) !== 'super admin'

                &&

                !empty($newParentRoleId)

            ) {

                $query =
                    $db->prepare(
                        "
                        SELECT name
                        FROM roles
                        WHERE id = ?
                        LIMIT 1
                        "
                    );

                $query->execute([
                    $newParentRoleId
                ]);

                $parentRole =
                    $query->fetch();

                if (

                    $parentRole

                    &&

                    strtolower(
                        $parentRole['name']
                    ) === 'super admin'

                ) {

                    Flash::set(
                        'danger',
                        'You cannot assign Super Admin as a parent role.'
                    );

                    return $response->redirect(
                        url(
                            'dashboard/roles/edit/' .
                            $id
                        )
                    );
                }
            }

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
         * Role name
         */
        $name =
            trim(
                $_POST['name']
            );

        /**
         * Check duplicate role
         */
        $query =
            $db->prepare(
                "
                SELECT id
                FROM roles
                WHERE name = ?
                AND id != ?
                AND deleted_at IS NULL
                LIMIT 1
                "
            );

        $query->execute([

            $name,

            $id
        ]);

        $role =
            $query->fetch();

            /**
             * Protect Super Admin role
             */
            if (

                $role

                &&

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
                        'dashboard/roles'
                    )
                );
            }

        // Prevent duplicate role names
        if ($role)
        {

            Flash::set(

                'danger',

                'Role name already exists.'
            );

            return $response->redirect(

                url(
                    'dashboard/roles/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Update role
         */
        $query =
            $db->prepare(
                "
                UPDATE roles
                SET

                    parent_role_id = ?,

                    name = ?,

                    description = ?,

                    is_system = ?,

                    status = ?,

                    updated_at = NOW()

                WHERE id = ?
                "
            );

        $query->execute([

            $newParentRoleId,

            $name,

            trim(
                $_POST['description']
                ??
                ''
            ),

            $_POST['is_system']
                ??
                0,

            $_POST['status'],

            $id
        ]);

        /**
         * Security audit
         * for status changes
         */
        if (

            $oldRole['status']

            !=

            $_POST['status']

        ) {

            AuditLog::log(

                'status_changed',

                'roles',

                $id,

                [

                    'status' =>
                        $oldRole['status']

                ],

                [

                    'status' =>
                        $_POST['status']

                ],

                'security'
            );
        }

        /**
         * Audit log
         */
        AuditLog::log(

            'update',

            'roles',

            $id,

            [

                'parent_role_id' =>
                    $oldRole['parent_role_id'],

                'name' =>
                    $oldRole['name'],

                'description' =>
                    $oldRole['description'],

                'is_system' =>
                    $oldRole['is_system'],

                'status' =>
                    $oldRole['status']

            ],

            [

                'parent_role_id' =>
                    !empty($_POST['parent_role_id'])
                        ? $_POST['parent_role_id']
                        : null,

                'name' =>
                    $name,

                'description' =>
                    trim(
                        $_POST['description']
                        ?? ''
                    ),

                'is_system' =>
                    $_POST['is_system']
                        ?? 0,

                'status' =>
                    $_POST['status']

            ]
        );

        /**
         * Success
         */
        Flash::set(

            'success',

            'Role updated successfully.'
        );

        return $response->redirect(

            url(
                'dashboard/roles'
            )
        );
    }
}