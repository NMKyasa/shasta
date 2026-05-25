<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database\Connection;

class CategoryController
extends BaseController
{
    /**
     * Store category via AJAX
     */
    public function storeAjax(
        $request,
        $response
    )
    {
        /**
         * Category title
         */
        $title =
            trim(
                $_POST['title']
                ??
                ''
            );

        /**
         * Validate title
         */
        if (empty($title)) {

            return $response->json([

                'error' =>
                    'Category title is required.'
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

                        $title
                    )
                )
            );

        /**
         * Check duplicate slug
         */
        $checkQuery =
            $db->prepare("

                SELECT id
                FROM categories
                WHERE slug = ?
                LIMIT 1

            ");

        $checkQuery->execute([$slug]);

        /**
         * Ensure unique slug
         */
        if ($checkQuery->fetch()) {

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

        try {

            $query->execute([

                $title,

                $slug
            ]);

        } catch (\Exception $e) {

            return $response->json([

                'error' =>
                    $e->getMessage()
            ], 500);
        }

        /**
         * Return response
         */
        return $response->json([

            'id' =>
                $db->lastInsertId(),

            'title' =>
                $title
        ]);
    }
}