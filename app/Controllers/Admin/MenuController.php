<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Menu;
use App\Core\Database\Connection;
use App\Core\Services\Flash;

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
         * Validate name
         */
        if (
            empty($_POST['name'])
        ) {

            Flash::set(

                'danger',

                'Menu name is required.'
            );

            return $response->redirect(

                url('dashboard/menus/create')
            );
        }

        /**
         * Validate menu key
         */
        if (
            empty($_POST['menu_key'])
        ) {

            Flash::set(

                'danger',

                'Menu key is required.'
            );

            return $response->redirect(

                url('dashboard/menus/create')
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
        if (
            empty($_POST['name'])
        ) {

            Flash::set(

                'danger',

                'Menu name is required.'
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
         * Validate menu key
         */
        if (
            empty($_POST['menu_key'])
        ) {

            Flash::set(

                'danger',

                'Menu key is required.'
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