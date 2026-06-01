<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Auth\Authorization;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Validation\Validator;

class PermissionController extends BaseController
{
    /**
     * Display permissions listing
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
            'permissions.view'
        );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Get permissions
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
         * Render view
         */
        return $this->view(

            'admin.permissions.index',

            [
                'permissions' =>
                    $permissions
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
            'permissions.create'
        );

        /**
         * Render view
         */
        return $this->view(

            'admin.permissions.create',

            [],

            'layouts.admin'
        );
    }

    /**
     * Store permission
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
            'permissions.create'
        );

        /**
         * Validate request
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'module' =>
                        'required|max:255',

                    'action' =>
                        'required|max:255'
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
                    'dashboard/permissions/create'
                )
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Module
         */
        $module =
            strtolower(
                trim(
                    $_POST['module']
                )
            );

        /**
         * Action
         */
        $action =
            strtolower(
                trim(
                    $_POST['action']
                )
            );

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
         * Description
         */
        $description =
            trim(
                $_POST['description']
                ??
                ''
            );

        /**
         * Check duplicate permission
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

            Flash::set(

                'danger',

                'Permission already exists.'
            );

            return $response->redirect(

                url(
                    'dashboard/permissions/create'
                )
            );
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

            $description
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Permission created successfully.'
        );

        return $response->redirect(

            url(
                'dashboard/permissions'
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
            'permissions.edit'
        );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Find permission
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
            $id
        ]);

        $permission =
            $query->fetch();

        /**
         * Permission not found
         */
        if (
            !$permission
        ) {

            Flash::set(

                'danger',

                'Permission not found.'
            );

            return $response->redirect(

                url(
                    'dashboard/permissions'
                )
            );
        }

        /**
         * Render view
         */
        return $this->view(

            'admin.permissions.edit',

            [
                'permission' =>
                    $permission
            ],

            'layouts.admin'
        );
    }

    /**
     * Update permission
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
            'permissions.edit'
        );

        /**
         * Validate request
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'module' =>
                        'required|max:255',

                    'action' =>
                        'required|max:255'
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
                    'dashboard/permissions/edit/'
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
         * Module
         */
        $module =
            strtolower(
                trim(
                    $_POST['module']
                )
            );

        /**
         * Action
         */
        $action =
            strtolower(
                trim(
                    $_POST['action']
                )
            );

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
         * Check duplicate permission
         */
        $query =
            $db->prepare(
                "
                SELECT id
                FROM permissions
                WHERE name = ?
                AND id != ?
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

                'Permission already exists.'
            );

            return $response->redirect(

                url(
                    'dashboard/permissions/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Update permission
         */
        $query =
            $db->prepare(
                "
                UPDATE permissions
                SET

                    module = ?,

                    action = ?,

                    name = ?,

                    description = ?,

                    updated_at = NOW()

                WHERE id = ?
                "
            );

        $query->execute([

            $module,

            $action,

            $name,

            trim(
                $_POST['description']
                ??
                ''
            ),

            $id
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Permission updated successfully.'
        );

        return $response->redirect(

            url(
                'dashboard/permissions'
            )
        );
    }
}