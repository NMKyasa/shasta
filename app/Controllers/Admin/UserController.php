<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Validation\Validator;
use App\Core\Database\Connection;
use App\Core\Services\Auth;
use App\Core\Services\Flash;
use App\Core\Auth\Authorization;

class UserController
extends BaseController
{
    /**
     * Users listing
     */
    public function index(
        $request,
        $response
    )
    {
        Authorization::authorize(
            'users.view'
        );

        /**
         * Current user
         */
        $currentUser =
            Auth::user();

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Current role
         */
        $roleQuery =
            $db->prepare(
                "
                SELECT *
                FROM roles
                WHERE id = ?
                LIMIT 1
                "
            );

        $roleQuery->execute([
            $currentUser['role_id']
        ]);

        $currentRole =
            $roleQuery->fetch();

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
                $db->query(
                    "
                    SELECT

                        users.*,

                        roles.name
                        AS role_name

                    FROM users

                    INNER JOIN roles

                        ON roles.id = users.role_id

                    ORDER BY users.id DESC
                    "
                );

        } else {

            /**
             * Admin and others
             * cannot see Super Admin
             */
            $query =
                $db->query(
                    "
                    SELECT

                        users.*,

                        roles.name
                        AS role_name

                    FROM users

                    INNER JOIN roles

                        ON roles.id = users.role_id

                    WHERE LOWER(
                        roles.name
                    ) != 'super admin'

                    ORDER BY users.id DESC
                    "
                );
        }

        /**
         * Users collection
         */
        $users =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.users.index',

            [

                'users' =>
                    $users
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
        Authorization::authorize(
            'users.create'
        );

        /**
         * Current user
         */
        $currentUser =
            Auth::user();

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Current role
         */
        $roleQuery =
            $db->prepare(
                "
                SELECT *
                FROM roles
                WHERE id = ?
                LIMIT 1
                "
            );

        $roleQuery->execute([
            $currentUser['role_id']
        ]);

        $currentRole =
            $roleQuery->fetch();

        /**
         * Super Admin
         * sees all active roles
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
                    WHERE status = 'active'
                    AND deleted_at IS NULL
                    ORDER BY name ASC
                    "
                );

        } else {

            /**
             * Admin cannot
             * assign Super Admin
             */
            $query =
                $db->query(
                    "
                    SELECT *
                    FROM roles
                    WHERE status = 'active'
                    AND deleted_at IS NULL
                    AND LOWER(name) != 'super admin'
                    ORDER BY name ASC
                    "
                );
        }

        /**
         * Roles
         */
        $roles =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.users.create',

            [

                'roles' =>
                    $roles
            ],

            'layouts.admin'
        );
    }

    /**
     * Store user
     */
    public function store(
        $request,
        $response
    )
    {
        Authorization::authorize(
            'users.create'
        );

        /**
         * Validate request
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'first_name'
                        =>
                        'required|max:255',

                    'last_name'
                        =>
                        'required|max:255',

                    'email'
                        =>
                        'required|email|max:255',

                    'role_id'
                        =>
                        'required|integer',

                    'password'
                        =>
                        'required|min:8|confirmed',

                    'status'
                        =>
                        'required|in:active,inactive'
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
                    'dashboard/users/create'
                )
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Email uniqueness
         */
        $emailQuery =
            $db->prepare(
                "
                SELECT id
                FROM users
                WHERE email = ?
                LIMIT 1
                "
            );

        $emailQuery->execute([

            $_POST['email']
        ]);

        if (
            $emailQuery->fetch()
        ) {

            Flash::set(

                'danger',

                'Email address already exists.'
            );

            return $response->redirect(

                url(
                    'dashboard/users/create'
                )
            );
        }

        /**
         * Selected role
         */
        $roleQuery =
            $db->prepare(
                "
                SELECT *
                FROM roles
                WHERE id = ?
                LIMIT 1
                "
            );

        $roleQuery->execute([

            $_POST['role_id']
        ]);

        $role =
            $roleQuery->fetch();

        /**
         * Role not found
         */
        if (
            !$role
        ) {

            Flash::set(

                'danger',

                'Selected role not found.'
            );

            return $response->redirect(

                url(
                    'dashboard/users/create'
                )
            );
        }

        /**
         * Current user role
         */
        $currentUser =
            Auth::user();

        $currentRoleQuery =
            $db->prepare(
                "
                SELECT *
                FROM roles
                WHERE id = ?
                LIMIT 1
                "
            );

        $currentRoleQuery->execute([

            $currentUser['role_id']
        ]);

        $currentRole =
            $currentRoleQuery->fetch();

        /**
         * Admin cannot
         * create Super Admin
         */
        if (

            strtolower(
                $currentRole['name']
            )
            !==
            'super admin'

            &&

            strtolower(
                $role['name']
            )
            ===
            'super admin'

        ) {

            Flash::set(

                'danger',

                'You cannot assign the Super Admin role.'
            );

            return $response->redirect(

                url(
                    'dashboard/users/create'
                )
            );
        }

        /**
         * Hash password
         */
        $password =
            password_hash(

                $_POST['password'],

                PASSWORD_DEFAULT
            );

        /**
         * Insert user
         */
        $query =
            $db->prepare(
                "
                INSERT INTO users
                (
                    role_id,
                    first_name,
                    last_name,
                    email,
                    password,
                    status,
                    created_at,
                    updated_at
                )
                VALUES
                (
                    ?, ?, ?, ?, ?, ?,
                    NOW(),
                    NOW()
                )
                "
            );

        $query->execute([

            $_POST['role_id'],

            $_POST['first_name'],

            $_POST['last_name'],

            $_POST['email'],

            $password,

            $_POST['status']
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'User created successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url(
                'dashboard/users'
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
        Authorization::authorize(
            'users.edit'
        );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * User to edit
         */
        $query =
            $db->prepare(
                "
                SELECT *
                FROM users
                WHERE id = ?
                LIMIT 1
                "
            );

        $query->execute([
            $id
        ]);

        $user =
            $query->fetch();

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
                    'dashboard/users'
                )
            );
        }

        /**
         * Current user
         */
        $currentUser =
            Auth::user();

        /**
         * Current role
         */
        $currentRoleQuery =
            $db->prepare(
                "
                SELECT *
                FROM roles
                WHERE id = ?
                LIMIT 1
                "
            );

        $currentRoleQuery->execute([
            $currentUser['role_id']
        ]);

        $currentRole =
            $currentRoleQuery->fetch();

        /**
         * Edited user's role
         */
        $editedRoleQuery =
            $db->prepare(
                "
                SELECT *
                FROM roles
                WHERE id = ?
                LIMIT 1
                "
            );

        $editedRoleQuery->execute([
            $user['role_id']
        ]);

        $editedRole =
            $editedRoleQuery->fetch();

        /**
         * Non-super-admin
         * cannot edit Super Admin
         */
        if (

            strtolower(
                $currentRole['name']
            )
            !==
            'super admin'

            &&

            strtolower(
                $editedRole['name']
            )
            ===
            'super admin'

        ) {

            Flash::set(

                'danger',

                'You cannot edit a Super Admin account.'
            );

            return $response->redirect(

                url(
                    'dashboard/users'
                )
            );
        }

        /**
         * Available roles
         */
        if (

            strtolower(
                $currentRole['name']
            )
            ===
            'super admin'

        ) {

            $rolesQuery =
                $db->query(
                    "
                    SELECT *
                    FROM roles
                    WHERE status = 'active'
                    AND deleted_at IS NULL
                    ORDER BY name ASC
                    "
                );

        } else {

            $rolesQuery =
                $db->query(
                    "
                    SELECT *
                    FROM roles
                    WHERE status = 'active'
                    AND deleted_at IS NULL
                    AND LOWER(name) != 'super admin'
                    ORDER BY name ASC
                    "
                );
        }

        $roles =
            $rolesQuery->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.users.edit',

            [

                'user' =>
                    $user,

                'roles' =>
                    $roles
            ],

            'layouts.admin'
        );
    }

    /**
     * Update user
     */
    public function update(
        $request,
        $response,
        $id
    )
    {
        Authorization::authorize(
            'users.edit'
        );

        /**
         * Validate request
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'first_name'
                        =>
                        'required|max:255',

                    'last_name'
                        =>
                        'required|max:255',

                    'email'
                        =>
                        'required|email|max:255',

                    'role_id'
                        =>
                        'required|integer',

                    'status'
                        =>
                        'required|in:active,inactive'
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
                    'dashboard/users/edit/'
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
         * Existing user
         */
        $query =
            $db->prepare(
                "
                SELECT *
                FROM users
                WHERE id = ?
                LIMIT 1
                "
            );

        $query->execute([
            $id
        ]);

        $user =
            $query->fetch();

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
                    'dashboard/users'
                )
            );
        }

        /**
         * Current user
         */
        $currentUser =
            Auth::user();

        /**
         * Current role
         */
        $currentRoleQuery =
            $db->prepare(
                "
                SELECT *
                FROM roles
                WHERE id = ?
                LIMIT 1
                "
            );

        $currentRoleQuery->execute([
            $currentUser['role_id']
        ]);

        $currentRole =
            $currentRoleQuery->fetch();

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
            $user['role_id']
        ]);

        $existingRole =
            $existingRoleQuery->fetch();

        /**
         * Non-super-admin
         * cannot edit Super Admin
         */
        if (

            strtolower(
                $currentRole['name']
            )
            !==
            'super admin'

            &&

            strtolower(
                $existingRole['name']
            )
            ===
            'super admin'

        ) {

            Flash::set(

                'danger',

                'You cannot edit a Super Admin account.'
            );

            return $response->redirect(

                url(
                    'dashboard/users'
                )
            );
        }

        /**
         * Email uniqueness
         */
        $emailQuery =
            $db->prepare(
                "
                SELECT id
                FROM users
                WHERE email = ?
                AND id != ?
                LIMIT 1
                "
            );

        $emailQuery->execute([

            $_POST['email'],

            $id
        ]);

        if (
            $emailQuery->fetch()
        ) {

            Flash::set(

                'danger',

                'Email address already exists.'
            );

            return $response->redirect(

                url(
                    'dashboard/users/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Selected role
         */
        $selectedRoleQuery =
            $db->prepare(
                "
                SELECT *
                FROM roles
                WHERE id = ?
                LIMIT 1
                "
            );

        $selectedRoleQuery->execute([

            $_POST['role_id']
        ]);

        $selectedRole =
            $selectedRoleQuery->fetch();

        /**
         * Role validation
         */
        if (
            !$selectedRole
        ) {

            Flash::set(

                'danger',

                'Selected role not found.'
            );

            return $response->redirect(

                url(
                    'dashboard/users/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Admin cannot
         * assign Super Admin
         */
        if (

            strtolower(
                $currentRole['name']
            )
            !==
            'super admin'

            &&

            strtolower(
                $selectedRole['name']
            )
            ===
            'super admin'

        ) {

            Flash::set(

                'danger',

                'You cannot assign the Super Admin role.'
            );

            return $response->redirect(

                url(
                    'dashboard/users/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Prevent self-deactivation
         */
        if (

            $currentUser['id']
            ==
            $id

            &&

            $_POST['status']
            ===
            'inactive'

        ) {

            Flash::set(

                'danger',

                'You cannot deactivate your own account.'
            );

            return $response->redirect(

                url(
                    'dashboard/users/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Update user
         */
        $updateQuery =
            $db->prepare(
                "
                UPDATE users
                SET

                    role_id = ?,

                    first_name = ?,

                    last_name = ?,

                    email = ?,

                    status = ?,

                    updated_at = NOW()

                WHERE id = ?
                "
            );

        $updateQuery->execute([

            $_POST['role_id'],

            $_POST['first_name'],

            $_POST['last_name'],

            $_POST['email'],

            $_POST['status'],

            $id
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'User updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url(
                'dashboard/users'
            )
        );
    }
}