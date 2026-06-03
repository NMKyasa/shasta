<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuItem;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Validation\Validator;
use App\Core\Auth\Authorization;
use App\Core\Services\AuditLog;

class MenuItemController
extends BaseController
{
    /**
     * Menu items listing
     */
    public function index(
        $request,
        $response
    )
    {
            /**
            * Check authorization
            */
        Authorization::authorize('menu_items.view');

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch menu items
         */
        $query =
            $db->query("

                SELECT

                    menu_items.*,

                    menus.name AS menu_name,

                    parent.label AS parent_label

                FROM menu_items

                LEFT JOIN menus

                    ON menus.id = menu_items.menu_id

                LEFT JOIN menu_items parent

                    ON parent.id = menu_items.parent_id

                ORDER BY menu_items.sort_order ASC

            ");

        $menuItems =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.menu-items.index',

            [

                'menuItems' =>
                    $menuItems
            ],

            'layouts.admin'
        );
    }

    /**
     * Create form
     */
    public function create(
        $request,
        $response
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('menu_items.create');
       
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Menus
         */
        $menus =
            $db->query("

                SELECT *

                FROM menus

                WHERE status = 'active'

                ORDER BY name ASC

            ")->fetchAll();

        /**
         * Parent items
         */
        $parentItems =
            $db->query("

                SELECT *

                FROM menu_items

                WHERE status = 'active'

                ORDER BY label ASC

            ")->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.menu-items.create',

            [

                'menus' =>
                    $menus,

                'parentItems' =>
                    $parentItems
            ],

            'layouts.admin'
        );
    }

    /**
     * Store menu item
     */
    public function store(
        $request,
        $response
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('menu_items.create');

        /**
         * Validate
         */
        $validator = Validator::make(

            $_POST,

            [

                'label' => 'required|max:255',

                'menu_id' => 'required|exists:menus,id'

            ]

        );

        if ($validator->fails()) {

            Flash::set(

                'danger',

                implode('<br>', $validator->all())
            );

            return $response->redirect(

                url('dashboard/menu-items/create')
            );
        }


        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Insert item
         */
        $query =
            $db->prepare("

                INSERT INTO menu_items (

                    menu_id,
                    parent_id,
                    label,
                    url,
                    target,
                    icon,
                    sort_order,
                    status,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                )

            ");

        $query->execute([

            $_POST['menu_id'],

            !empty($_POST['parent_id'])
                ? $_POST['parent_id']
                : null,

            $_POST['label'],

            $_POST['url'],

            $_POST['target'],

            $_POST['icon'],

            $_POST['sort_order']
                ??
                0,

            $_POST['status']
        ]);

        // Audit log
        AuditLog::log(

            'create',

            'menu_items',

            $db->lastInsertId(),

            null,

            [
                'menu_id' => $_POST['menu_id'],
                'parent_id' => $_POST['parent_id'] ?? null,
                'label' => $_POST['label'],
                'url' => $_POST['url'],
                'target' => $_POST['target'],
                'icon' => $_POST['icon'],
                'sort_order' => $_POST['sort_order'] ?? 0,
                'status' => $_POST['status']
            ]

        );


        /**
         * Success
         */
        Flash::set(

            'success',

            'Menu item created successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/menu-items')
        );
    }

    /**
     * Edit form
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
        Authorization::authorize('menu_items.edit');

        /**
         * Find item
         */
        $menuItem =
            MenuItem::find($id);

        /**
         * Not found
         */
        if (!$menuItem) {

            return $response->notFound(
                'Menu item not found.'
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

            // Fetch existing menu item for audit logging
        $existingMenuItem = $menuItem->toArray();

        /**
         * Menus
         */
        $menus =
            $db->query("

                SELECT *

                FROM menus

                WHERE status = 'active'

                ORDER BY name ASC

            ")->fetchAll();

        /**
         * Parent items
         */
        $parentItems =
            $db->prepare("

                SELECT *

                FROM menu_items

                WHERE id != ?

                ORDER BY label ASC

            ");

        $parentItems->execute([$id]);

        /**
         * Render page
         */
        $this->view(

            'admin.menu-items.edit',

            [

                'menuItem' =>
                    $menuItem,

                'menus' =>
                    $menus,

                'parentItems' =>
                    $parentItems->fetchAll()
            ],

            'layouts.admin'
        );
    }

    /**
     * Update menu item
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
        Authorization::authorize('menu_items.edit');

        /**
         * Find item
         */
        $menuItem =
            MenuItem::find($id);

        // Fetch existing menu item for audit logging
        $existingMenuItem = $menuItem ? $menuItem->toArray() : null;

            // Validate
        $validator = Validator::make(

            $_POST,

            [

                'label' => 'required|max:255',

                'menu_id' => 'required|exists:menus,id',

                'sort_order' => 'required|integer',

                'status' => 'required|in:active,inactive'

            ]

        );

        if ($validator->fails()) {

            Flash::set(

                'danger',

                implode('<br>', $validator->all())
            );

            return $response->redirect(

                url('dashboard/menu-items/edit/' . $id)
            );
        }

        /**
         * Not found
         */
        if (!$menuItem) {

            return $response->notFound(
                'Menu item not found.'
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Update item
         */
        $query =
            $db->prepare("

                UPDATE menu_items

                SET

                    menu_id = ?,
                    parent_id = ?,
                    label = ?,
                    url = ?,
                    target = ?,
                    icon = ?,
                    sort_order = ?,
                    status = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        $query->execute([

            $_POST['menu_id'],

            !empty($_POST['parent_id'])
                ? $_POST['parent_id']
                : null,

            $_POST['label'],

            $_POST['url'],

            $_POST['target'],

            $_POST['icon'],

            $_POST['sort_order']
                ??
                0,

            $_POST['status'],

            $id
        ]);

        // Audit log
        AuditLog::log(

            'update',

            'menu_items',

            $id,

            $existingMenuItem,

            [
                'menu_id' => $_POST['menu_id'],
                'parent_id' => $_POST['parent_id'] ?? null,
                'label' => $_POST['label'],
                'url' => $_POST['url'],
                'target' => $_POST['target'],
                'icon' => $_POST['icon'],
                'sort_order' => $_POST['sort_order'] ?? 0,
                'status' => $_POST['status']
            ]

        );

        // Audit log
        AuditLog::log(

            'update',

            'menu_items',

            $id,

            $existingMenuItem,

            [
                'menu_id' => $_POST['menu_id'],
                'parent_id' => $_POST['parent_id'] ?? null,
                'label' => $_POST['label'],
                'url' => $_POST['url'],
                'target' => $_POST['target'],
                'icon' => $_POST['icon'],
                'sort_order' => $_POST['sort_order'] ?? 0,
                'status' => $_POST['status']
            ]

        );



        /**
         * Success
         */
        Flash::set(

            'success',

            'Menu item updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/menu-items')
        );
    }
}