<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Validation\Validator;

class CategoryController
extends BaseController
{
    /**
     * Categories listing
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
         * Fetch categories
         */
        $query =
            $db->query("

                SELECT *
                FROM categories
                ORDER BY id DESC

            ");

        /**
         * Categories results
         */
        $categories =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.categories.index',

            [

                'categories' =>
                    $categories
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
         * Render page
         */
        $this->view(

            'admin.categories.create',

            [],

            'layouts.admin'
        );
    }

    /**
     * Store category
     */
    public function store(
        $request,
        $response
    )
    {
        /**
         * Category name
         */
        $name =
            trim(
                $_POST['name']
                ??
                ''
            );

        /**
         * Category status
         */
        $status =
            $_POST['status']
            ??
            'active';

        /**
         * Validate category
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'name' =>
                        'required|max:255',

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
                    'dashboard/categories/create'
                )
            );
        }

        /**
         * Generate slug
         */
        $slug =
            strtolower(
                trim(
                    preg_replace(

                        '/[^A-Za-z0-9-]+/',

                        '-',

                        $name
                    )
                )
            );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Ensure unique slug
         */
        $slugCheck =
            $db->prepare("

                SELECT id
                FROM categories
                WHERE slug = ?
                LIMIT 1

            ");

        $slugCheck->execute([$slug]);

        /**
         * Append timestamp if slug exists
         */
        if ($slugCheck->fetch()) {

            $slug .= '-'
                .
                time();
        }

        /**
         * Insert category
         */
        $query =
            $db->prepare("

                INSERT INTO categories (

                    name,
                    slug,
                    status,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, NOW(), NOW()

                )

            ");

        /**
         * Execute insert
         */
        $query->execute([

            $name,

            $slug,

            $status
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Category created successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/categories')
        );
    }

    /**
     * Edit category form
     */
    public function edit(
        $request,
        $response,
        $id
    )
    {
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch category
         */
        $query =
            $db->prepare("

                SELECT *
                FROM categories
                WHERE id = ?
                LIMIT 1

            ");

        $query->execute([$id]);

        /**
         * Category result
         */
        $category =
            $query->fetch();

        /**
         * Category not found
         */
        if (!$category) {

            Flash::set(

                'danger',

                'Category not found.'
            );

            return $response->redirect(

                url('dashboard/categories')
            );
        }

        /**
         * Render page
         */
        $this->view(

            'admin.categories.edit',

            [

                'category' =>
                    $category
            ],

            'layouts.admin'
        );
    }

    /**
     * Update category
     */
    public function update(
        $request,
        $response,
        $id
    )
    {
        /**
         * Category name
         */
        $name =
            trim(
                $_POST['name']
                ??
                ''
            );

        /**
         * Category status
         */
        $status =
            $_POST['status']
            ??
            'active';

        /**
         * Validate category
         */
        $validator =
            Validator::make(

                $_POST,

                [

                    'name' =>
                        'required|max:255',

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
                    'dashboard/categories/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Generate slug
         */
        $slug =
            strtolower(
                trim(
                    preg_replace(

                        '/[^A-Za-z0-9-]+/',

                        '-',

                        $name
                    )
                )
            );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Ensure unique slug
         */
        $slugCheck =
            $db->prepare("

                SELECT id
                FROM categories
                WHERE slug = ?
                AND id != ?
                LIMIT 1

            ");

        $slugCheck->execute([

            $slug,

            $id
        ]);

        /**
         * Append timestamp if slug exists
         */
        if ($slugCheck->fetch()) {

            $slug .= '-'
                .
                time();
        }

        /**
         * Update category
         */
        $query =
            $db->prepare("

                UPDATE categories

                SET

                    name = ?,
                    slug = ?,
                    status = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        /**
         * Execute update
         */
        $query->execute([

            $name,

            $slug,

            $status,

            $id
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Category updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/categories')
        );
    }

    /**
     * Store category via AJAX
     */
    public function storeAjax(
        $request,
        $response
    )
    {
        /**
         * Category name
         */
        $name =
            trim(
                $_POST['title']
                ??
                ''
            );

        /**
         * Validate category name
         */
        if (empty($name)) {

            return $response->json([

                'error' =>
                    'Category name is required.'
            ], 422);
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Generate slug
         */
        $slug =
            strtolower(
                trim(
                    preg_replace(

                        '/[^A-Za-z0-9-]+/',

                        '-',

                        $name
                    )
                )
            );

        /**
         * Ensure unique slug
         */
        $slugCheck =
            $db->prepare("

                SELECT id
                FROM categories
                WHERE slug = ?
                LIMIT 1

            ");

        $slugCheck->execute([$slug]);

        /**
         * Append timestamp if slug exists
         */
        if ($slugCheck->fetch()) {

            $slug .= '-'
                .
                time();
        }

        /**
         * Insert category
         */
        $query =
            $db->prepare("

                INSERT INTO categories (

                    name,
                    slug,
                    status,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, 'active', NOW(), NOW()

                )

            ");

        /**
         * Execute insert
         */
        $query->execute([

            $name,

            $slug
        ]);

        /**
         * Return JSON response
         */
        return $response->json([

            'id' =>
                $db->lastInsertId(),

            'name' =>
                $name
        ]);
    }
}