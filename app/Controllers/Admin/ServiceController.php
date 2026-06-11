<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Service;
use App\Models\Category;
use App\Core\Validation\Validator;
use App\Models\Media;
use App\Core\Services\Auth;
use App\Core\Services\UploadService;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Auth\Authorization;
use App\Core\Services\AuditLog;

class ServiceController
extends BaseController
    {
     /**
     * Services listing
     */
    public function index(
        $request,
        $response
    )
    {
        Authorization::authorize('services.view');

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch services
         * with featured images
         */
        $query =
            $db->query("

                SELECT

                    services.*,

                    media.file_path AS featured_image

                FROM services

                LEFT JOIN media

                    ON media.mediable_id = services.id

                    AND media.mediable_type = 'service'

                    AND media.is_featured = 1

                ORDER BY services.id DESC

            ");

        $services =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.services.index',

            [

                'services' =>
                    $services
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
        Authorization::authorize('services.create');

        /**
         * Fetch categories
         */
        $categories =
            Category::where(
                'status',
                'active'
            );

        /**
         * Render page
         */
        $this->view(

            'admin.services.create',

            [

                'categories' =>
                    $categories
            ],

            'layouts.admin'
        );
    }

        /**
     * Store service
     */
    public function store(
        $request,
        $response
    )
    {
        Authorization::authorize('services.create');

        /**
         * Validate request
         */
        $validator = Validator::make(
            $_POST,
            [
                'title' => 'required|max:255',

                'category_id' => 'required|exists:categories,id',

                'status' => 'required|in:active,inactive'
            ]
        );
        if ($validator->fails()) {

            Flash::set(

                'danger',

                implode('<br>', $validator->all())
            );

            return $response->redirect(

                url('dashboard/services/create')
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

                        $_POST['title']
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
                FROM services
                WHERE slug = ?
                LIMIT 1

            ");

        $slugCheck->execute([$slug]);

        if ($slugCheck->fetch()) {

            $slug .= '-'
                .
                time();
        }

        /**
         * Insert service
         */
        $query =
            $db->prepare("

                INSERT INTO services (

                    title,
                    slug,
                    summary,
                    body,
                    meta_title,
                    meta_description,
                    meta_keywords,
                    featured,
                    status,
                    created_by,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                )

            ");

        $query->execute([

            $_POST['title'],

            $slug,

            $_POST['summary']
                ??
                null,

            $_POST['body']
                ??
                null,

            $_POST['meta_title']
                ??
                null,

            $_POST['meta_description']
                ??
                null,

            $_POST['meta_keywords']
                ??
                null,

            isset($_POST['featured'])
                ? 1
                : 0,

            $_POST['status'],

            Auth::id()
        ]);

        /**
         * Service ID
         */
        $serviceId =
            $db->lastInsertId();

            /**
             * Audit log
             */
            AuditLog::log(

                'create',

                'services',

                $serviceId,

                null,

                [

                    'title' =>
                        $_POST['title'],

                    'slug' =>
                        $slug,

                    'category_id' =>
                        $_POST['category_id'],

                    'featured' =>
                        isset($_POST['featured'])
                            ? 1
                            : 0,

                    'status' =>
                        $_POST['status']

                ]
            );

        /**
         * Attach category
         */
        $categoryQuery =
            $db->prepare("

                INSERT INTO categoryables (

                    category_id,
                    categoryable_type,
                    categoryable_id,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, NOW(), NOW()

                )

            ");

        $categoryQuery->execute([

            $_POST['category_id'],

            'service',

            $serviceId
        ]);

        /**
         * Uploaded images
         */
        $images =
            $_FILES['images'];

        /**
         * Loop images
         */
        foreach (

            $images['name']
            as
            $index => $name

        ) {

            /**
             * Normalize file array
             */
            $file = [

                'name' =>
                    $images['name'][$index],

                'type' =>
                    $images['type'][$index],

                'tmp_name' =>
                    $images['tmp_name'][$index],

                'error' =>
                    $images['error'][$index],

                'size' =>
                    $images['size'][$index]
            ];

            /**
             * Upload securely
             *
             * SECURITY:
             * - mime validation
             * - image validation
             * - size validation
             * - randomized names
             */
            $upload =
                UploadService::uploadImage(

                    $file,

                    'services'
                );

            /**
             * Featured image
             *
             * First image becomes featured
             */
            $isFeatured =
                $index === 0
                    ? 1
                    : 0;

            /**
             * Store media
             */
            $mediaQuery =
                $db->prepare("

                    INSERT INTO media (

                        mediable_type,
                        mediable_id,
                        file_name,
                        file_path,
                        mime_type,
                        file_size,
                        is_featured,
                        sort_order,
                        status,
                        created_at,
                        updated_at

                    )

                    VALUES (

                        ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                    )

                ");

            $mediaQuery->execute([

                'service',

                $serviceId,

                $upload['file_name'],

                $upload['file_path'],

                $upload['mime_type'],

                $upload['file_size'],

                $isFeatured,

                $index,

                'active'
            ]);
        }

        /**
         * Redirect
         */
        Flash::set(

            'success',

            'Service created successfully.'
        );

        return $response->redirect(

            url('dashboard/services')
        );
    }

     /**
     * Edit service form
     */
    public function edit(
        $request,
        $response,
        $id
    )
    {
        Authorization::authorize('services.edit');
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch service
         */
        $service =
            Service::find($id);

        /**
         * Service not found
         */
        if (!$service) {

            return $response->notFound(
                'Service not found.'
            );
        }

        /**
         * Fetch categories
         */
        $categories =
            Category::where(
                'status',
                'active'
            );

        /**
         * Fetch selected category
         */
        $categoryQuery =
            $db->prepare("

                SELECT category_id
                FROM categoryables
                WHERE categoryable_type = ?
                AND categoryable_id = ?
                LIMIT 1

            ");

        $categoryQuery->execute([

            'service',

            $id
        ]);

        $category =
            $categoryQuery->fetch();

        /**
         * Fetch media gallery
         */
        $mediaQuery =
            $db->prepare("

                SELECT *
                FROM media
                WHERE mediable_type = ?
                AND mediable_id = ?
                ORDER BY sort_order ASC

            ");

        $mediaQuery->execute([

            'service',

            $id
        ]);

        $media =
            $mediaQuery->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.services.edit',

            [

                'service' =>
                    $service,

                'categories' =>
                    $categories,

                'selectedCategory' =>
                    $category['category_id']
                    ??
                    null,

                'media' =>
                    $media
            ],

            'layouts.admin'
        );
    }

        /**
     * Update service
     */
    public function update(
        $request,
        $response,
        $id
    )
    {
        Authorization::authorize('services.edit');
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch service
         */
        $service =
            Service::find($id);

            /**
         * Original service
         * for audit logging
         */
        $oldService =
            $service;

        /**
         * Service not found
         */
        if (!$service) {

            return $response->notFound(
                'Service not found.'
            );
        }

            /**
            * Validate input
            */
        $validator = Validator::make(
            $_POST,
            [
                'title' => 'required|max:255',

                'category_id' => 'required|exists:categories,id',

                'status' => 'required|in:active,inactive'
            ]
        );

        if ($validator->fails()) {

            Flash::set(

                'danger',

                implode('<br>', $validator->all())
            );

            return $response->redirect(

                url('dashboard/services/edit/' . $id)
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

                        $_POST['title']
                    )
                )
            );

        /**
         * Ensure unique slug
         */
        $slugCheck =
            $db->prepare("

                SELECT id
                FROM services
                WHERE slug = ?
                AND id != ?
                LIMIT 1

            ");

        $slugCheck->execute([

            $slug,

            $id
        ]);

        if ($slugCheck->fetch()) {

            $slug .= '-'
                .
                time();
        }

        /**
         * Update service
         */
        $query =
            $db->prepare("

                UPDATE services

                SET

                    title = ?,
                    slug = ?,
                    summary = ?,
                    body = ?,
                    meta_title = ?,
                    meta_description = ?,
                    meta_keywords = ?,
                    featured = ?,
                    status = ?,
                    updated_by = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        $query->execute([

            $_POST['title'],

            $slug,

            $_POST['summary']
                ??
                null,

            $_POST['body']
                ??
                null,

            $_POST['meta_title']
                ??
                null,

            $_POST['meta_description']
                ??
                null,

            $_POST['meta_keywords']
                ??
                null,

            isset($_POST['featured'])
                ? 1
                : 0,

            $_POST['status'],

            Auth::id(),

            $id
        ]);

        /**
         * Status changed
         */
        if (

            $oldService['status']

            !=

            $_POST['status']

        ) {

            AuditLog::log(

                'status_changed',

                'services',

                $id,

                [

                    'status' =>
                        $oldService['status']

                ],

                [

                    'status' =>
                        $_POST['status']

                ]
            );
        }

        /**
         * Featured changed
         */
        if (

            $oldService['featured']

            !=

            (
                isset($_POST['featured'])
                    ? 1
                    : 0
            )

        ) {

            AuditLog::log(

                'featured_changed',

                'services',

                $id,

                [

                    'featured' =>
                        $oldService['featured']

                ],

                [

                    'featured' =>
                        isset($_POST['featured'])
                            ? 1
                            : 0

                ]
            );
        }

        /**
         * Existing category
         */
        $categoryQuery =
            $db->prepare(

                "
                SELECT category_id
                FROM categoryables
                WHERE categoryable_type = ?
                AND categoryable_id = ?
                LIMIT 1
                "
            );

        $categoryQuery->execute([

            'service',

            $id
        ]);

        $oldCategory =
            $categoryQuery->fetch();

        /**
         * Update category
         */
        $deleteCategory =
            $db->prepare("

                DELETE FROM categoryables

                WHERE categoryable_type = ?
                AND categoryable_id = ?

            ");

        $deleteCategory->execute([

            'service',

            $id
        ]);

        /**
         * Reinsert category
         */
        $categoryInsert =
            $db->prepare("

                INSERT INTO categoryables (

                    category_id,
                    categoryable_type,
                    categoryable_id,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, NOW(), NOW()

                )

            ");

        $categoryInsert->execute([

            $_POST['category_id'],

            'service',

            $id
        ]);

        /**
         * Category changed
         */
        if (

            $oldCategory

            &&

            $oldCategory['category_id']

            !=

            $_POST['category_id']

        ) {

            AuditLog::log(

                'category_changed',

                'services',

                $id,

                [

                    'category_id' =>
                        $oldCategory['category_id']

                ],

                [

                    'category_id' =>
                        $_POST['category_id']

                ]
            );
        }

        /**
         * Delete selected images
         */
        if (
            !empty($_POST['delete_images'])
        ) {

            foreach (

                $_POST['delete_images']
                as
                $mediaId

            ) {

                /**
                 * Fetch image
                 */
                $mediaQuery =
                    $db->prepare("

                        SELECT *
                        FROM media
                        WHERE id = ?
                        LIMIT 1

                    ");

                $mediaQuery->execute([

                    $mediaId
                ]);

                $media =
                    $mediaQuery->fetch();

                /**
                 * Delete physical file
                 */
                if (
                    $media
                    &&
                    file_exists(

                        __DIR__
                        .
                        '/../../../public/'
                        .
                        $media['file_path']
                    )
                ) {

                    unlink(

                        __DIR__
                        .
                        '/../../../public/'
                        .
                        $media['file_path']
                    );
                }

                /**
                 * Prevent deleting featured image
                 * without replacement
                 */
                if (
                    $media['is_featured']
                    &&
                    empty($_POST['featured_image'])
                ) {

                    continue;
                }

                /**
                 * Delete database row
                 */
                $deleteMedia =
                    $db->prepare("

                        DELETE FROM media
                        WHERE id = ?

                    ");

                $deleteMedia->execute([

                    $mediaId
                ]);
            }
        }

        /**
         * Update featured image
         */
        if (
            !empty($_POST['featured_image'])
        ) {

            /**
             * Reset all featured flags
             */
            $resetFeatured =
                $db->prepare("

                    UPDATE media

                    SET is_featured = 0

                    WHERE mediable_type = ?
                    AND mediable_id = ?

                ");

            $resetFeatured->execute([

                'service',

                $id
            ]);

            /**
             * Set selected image
             */
            $setFeatured =
                $db->prepare("

                    UPDATE media

                    SET is_featured = 1

                    WHERE id = ?

                ");

            $setFeatured->execute([

                $_POST['featured_image']
            ]);
        }

        /**
         * Upload new images
         */
        if (
            !empty($_FILES['images']['name'][0])
        ) {

            $images =
                $_FILES['images'];

            /**
             * Existing media count
             */
            $countQuery =
                $db->prepare("

                    SELECT COUNT(*) as total
                    FROM media
                    WHERE mediable_type = ?
                    AND mediable_id = ?

                ");

            $countQuery->execute([

                'service',

                $id
            ]);

            $count =
                $countQuery->fetch();

            $sortOrder =
                $count['total'];

            /**
             * Loop images
             */
            foreach (

                $images['name']
                as
                $index => $name

            ) {

                /**
                 * Normalize file
                 */
                $file = [

                    'name' =>
                        $images['name'][$index],

                    'type' =>
                        $images['type'][$index],

                    'tmp_name' =>
                        $images['tmp_name'][$index],

                    'error' =>
                        $images['error'][$index],

                    'size' =>
                        $images['size'][$index]
                ];

                /**
                 * Upload securely
                 */
                $upload =
                    UploadService::uploadImage(

                        $file,

                        'services'
                    );

                /**
                 * Store media
                 */
                $mediaInsert =
                    $db->prepare("

                        INSERT INTO media (

                            mediable_type,
                            mediable_id,
                            file_name,
                            file_path,
                            mime_type,
                            file_size,
                            is_featured,
                            sort_order,
                            status,
                            created_at,
                            updated_at

                        )

                        VALUES (

                            ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                        )

                    ");

                /**
                 * Featured logic
                 */
                $isFeatured =
                    0;

                /**
                 * Check existing featured image
                 */
                $featuredCheck =
                    $db->prepare("

                        SELECT id
                        FROM media
                        WHERE mediable_type = ?
                        AND mediable_id = ?
                        AND is_featured = 1
                        LIMIT 1

                    ");

                $featuredCheck->execute([

                    'service',

                    $id
                ]);

                /**
                 * If none exists
                 */
                if (
                    !$featuredCheck->fetch()
                ) {

                    $isFeatured = 1;
                }

                $mediaInsert->execute([

                    'service',

                    $id,

                    $upload['file_name'],

                    $upload['file_path'],

                    $upload['mime_type'],

                    $upload['file_size'],

                    $isFeatured,

                    $sortOrder,

                    'active'
                ]);

                $sortOrder++;
            }
        }

        /**
         * Ensure at least one image remains
         */
        $imageCheck =
            $db->prepare("

                SELECT COUNT(*) as total
                FROM media
                WHERE mediable_type = ?
                AND mediable_id = ?

            ");

        $imageCheck->execute([

            'service',

            $id
        ]);

        $remaining =
            $imageCheck->fetch();

        if ($remaining['total'] < 1) {

            return $response->send(
                'A service must have at least one image.'
            );
        }

        /**
         * Audit log
         */
        AuditLog::log(

            'update',

            'services',

            $id,

            [

                'title' =>
                    $oldService['title'],

                'slug' =>
                    $oldService['slug'],

                'featured' =>
                    $oldService['featured'],

                'status' =>
                    $oldService['status']

            ],

            [

                'title' =>
                    $_POST['title'],

                'slug' =>
                    $slug,

                'featured' =>
                    isset($_POST['featured'])
                        ? 1
                        : 0,

                'status' =>
                    $_POST['status']

            ]
        );

        Flash::set(

            'success',

            'Service updated successfully.'
        );
        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/services')
        );
    }
}