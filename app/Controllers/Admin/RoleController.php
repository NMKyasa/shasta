<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Validation\Validator;
use App\Core\Auth\Authorization;

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
         * Get roles
         */
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
         * Parent roles
         */
        $query =
            $db->query(
                "
                SELECT *
                FROM roles
                WHERE deleted_at IS NULL
                ORDER BY name ASC
                "
            );

        $roles =
            $query->fetchAll();

        /**
         * Render view
         */
        return $this->view(

            'admin.roles.create',

            [
                'roles' => $roles
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
         * Find role
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
         * Parent roles
         */
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

                'roles' => $roles
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

        if (
            $query->fetch()
        ) {

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

            !empty($_POST['parent_role_id'])
                ? $_POST['parent_role_id']
                : null,

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