<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Menu;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Validation\Validator;
use App\Core\Auth\Authorization;
use App\Core\Services\AuditLog;

class MenuController
extends BaseController
{
    /**
     * Menus listing
     */
    public function index(
        $request,
        $response
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('menus.view');

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch menus
         */
        $query =
            $db->query("

                SELECT *

                FROM menus

                ORDER BY id DESC

            ");

        /**
         * Menus collection
         */
        $menus =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.menus.index',

            [

                'menus' =>
                    $menus
            ],

            'layouts.admin'
        );
    }

    /**
     * Create menu form
     */
    public function create(
        $request,
        $response
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('menus.create');

        /**
         * Render page
         */
        $this->view(

            'admin.menus.create',

            [],

            'layouts.admin'
        );
    }

    /**
     * Store menu
     */
    public function store(
        $request,
        $response
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('menus.create');

        /**
         * Validate request
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'name' =>
                        'required|max:255',

                    'menu_key' =>
                        'required|in:header,footer,mobile',

                    'description' =>
                        'nullable|max:1000',

                    'status' =>
                        'required|in:active,inactive'
                ]
            );

        /**
         * Validation failed
         */
        if (
            $validator->fails()
        )
        {
            Flash::set(

                'danger',

                implode(

                    '<br>',

                    $validator->all()
                )
            );

            return $response->redirect(

                url(
                    'dashboard/menus/create'
                )
            );
        }


        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Check duplicate menu key
         */
        $checkQuery =
            $db->prepare("

                SELECT id

                FROM menus

                WHERE menu_key = ?

                LIMIT 1

            ");

        $checkQuery->execute([

            $_POST['menu_key']
        ]);

        /**
         * Prevent duplicate menu keys
         */
        if ($checkQuery->fetch()) {

            Flash::set(

                'danger',

                'Menu key already exists.'
            );

            return $response->redirect(

                url('dashboard/menus/create')
            );
        }

        /**
         * Insert menu
         */
        $query =
            $db->prepare("

                INSERT INTO menus (

                    name,
                    menu_key,
                    description,
                    status,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, ?, NOW(), NOW()

                )

            ");

        $query->execute([

            $_POST['name'],

            $_POST['menu_key'],

            $_POST['description']
                ?? null,

            $_POST['status']
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Menu created successfully.'
        );

        /**
         * Audit log
         */
        AuditLog::log(

            'create',

            'menus',

            $db->lastInsertId(),

            null,

            [

                'name' =>
                    $_POST['name'],

                'menu_key' =>
                    $_POST['menu_key'],

                'description' =>
                    $_POST['description']
                        ?? null,

                'status' =>
                    $_POST['status']
            ]
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/menus')
        );
    }

    /**
     * Edit menu form
     */
    public function edit(
        $request,
        $response,
        $id
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('menus.edit');

        /**
         * Find menu
         */
        $menu =
            Menu::find($id);

        /**
         * Menu not found
         */
        if (!$menu) {

            return $response->notFound(
                'Menu not found.'
            );
        }

        /**
         * Render page
         */
        $this->view(

            'admin.menus.edit',

            [

                'menu' =>
                    $menu
            ],

            'layouts.admin'
        );
    }

    /**
     * Update menu
     */
    public function update(
        $request,
        $response,
        $id
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('menus.edit');

        /**
         * Find menu
         */
        $menu =
            Menu::find($id);

        /**
         * Menu not found
         */
        if (!$menu) {

            return $response->notFound(
                'Menu not found.'
            );
        }

        /**
         * Validate name
         */
        /**
         * Validate request
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'name' =>
                        'required|max:255',

                    'menu_key' =>
                        'required|in:header,footer,mobile',

                    'description' =>
                        'nullable|max:1000',

                    'status' =>
                        'required|in:active,inactive'
                ]
            );

        /**
         * Validation failed
         */
        if (
            $validator->fails()
        )
        {
            Flash::set(

                'danger',

                implode(

                    '<br>',

                    $validator->all()
                )
            );

            return $response->redirect(

                url(
                    'dashboard/menus/edit/'
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

        // Fetch existing menu for audit logging
        $existingMenu = Menu::find($id);


        /**
         * Check duplicate menu key
         */
        $checkQuery =
            $db->prepare("

                SELECT id

                FROM menus

                WHERE menu_key = ?
                AND id != ?

                LIMIT 1

            ");

        $checkQuery->execute([

            $_POST['menu_key'],

            $id
        ]);

        /**
         * Prevent duplicate menu keys
         */
        if ($checkQuery->fetch()) {

            Flash::set(

                'danger',

                'Menu key already exists.'
            );

            return $response->redirect(

                url(
                    'dashboard/menus/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Update menu
         */
        $query =
            $db->prepare("

                UPDATE menus

                SET

                    name = ?,
                    menu_key = ?,
                    description = ?,
                    status = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        $query->execute([

            $_POST['name'],

            $_POST['menu_key'],

            $_POST['description']
                ?? null,

            $_POST['status'],

            $id
        ]);

        /**
         * Audit log
         */
        AuditLog::log(

            'update',

            'menus',

            $id,

            $existingMenu->toArray(),

            [

                'name' =>
                    $_POST['name'],

                'menu_key' =>
                    $_POST['menu_key'],

                'description' =>
                    $_POST['description']
                        ?? null,

                'status' =>
                    $_POST['status']
            ]
        );

        // audit log for menu items if menu key is changed
        if ($existingMenu->menu_key !== $_POST['menu_key']) {

            $menuItemsQuery = $db->prepare("

                SELECT id, label, url, target, icon, sort_order, status
                FROM menu_items
                WHERE menu_id = ?

            ");

            $menuItemsQuery->execute([$id]);

            $menuItems = $menuItemsQuery->fetchAll();

            foreach ($menuItems as $item) {

                AuditLog::log(

                    'update',

                    'menu_items',

                    $item['id'],

                    $item,

                    [

                        'menu_key' =>
                            $_POST['menu_key']
                    ]
                );
            }
        }

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Menu updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/menus')
        );
    }
}