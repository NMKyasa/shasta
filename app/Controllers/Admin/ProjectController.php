<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Project;
use App\Models\Category;
use App\Models\Media;
use App\Core\Validation\Validator;
use App\Core\Services\Auth;
use App\Core\Services\UploadService;
use App\Core\Services\Flash;
use App\Core\Database\Connection;
use App\Core\Auth\Authorization;
use App\Core\Services\AuditLog;

class ProjectController
extends BaseController
    {
     /**
     * Projects listing
     */
    public function index(
        $request,
        $response
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('projects.view');

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch projects
         * with featured images
         */
        $query =
            $db->query("

                SELECT

                    projects.*,

                    media.file_path AS featured_image

                FROM projects

                LEFT JOIN media

                    ON media.mediable_id = projects.id

                    AND media.mediable_type = 'project'

                    AND media.is_featured = 1

                ORDER BY projects.id DESC

            ");

        $projects =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.projects.index',

            [

                'projects' =>
                    $projects
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
         * Check authorization
         */
        Authorization::authorize('projects.create');

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

            'admin.projects.create',

            [

                'categories' =>
                    $categories
            ],

            'layouts.admin'
        );
    }

        /**
     * Store project
     */
    public function store(
        $request,
        $response
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('projects.create');

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

        if (
            empty($_FILES['images'])
            ||
            empty($_FILES['images']['name'][0])
        ) {

            Flash::set(
                'danger',
                'At least one image is required.'
            );

            return $response->redirect(
                url('dashboard/projects/create')
            );
        }

        if ($validator->fails()) {

            Flash::set(

                'danger',

                implode('<br>', $validator->all())
            );

            return $response->redirect(

                url('dashboard/projects/create')
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
                FROM projects
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
         * Insert project
         */
        $query =
            $db->prepare("

                INSERT INTO projects (

                    title,
                    slug,
                    client_name,
                    scope,
                    impact,
                    completion_date,
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

                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                )

            ");
            
        $query->execute([

            $_POST['title'],

            $slug,

            $_POST['client_name']
                ?? null,

            $_POST['scope']
                ?? null,

            $_POST['impact']
                ?? null,

            $_POST['completion_date']
                ?? null,

            $_POST['meta_title']
                ?? null,

            $_POST['meta_description']
                ?? null,

            $_POST['meta_keywords']
                ?? null,

            isset($_POST['featured'])
                ? 1
                : 0,

            $_POST['status'],

            Auth::id()
        ]);

        /**
         * Project ID
         */
        $projectId =
            $db->lastInsertId();

            /**
             * Audit log
             */
            AuditLog::log(

                'create',

                'projects',

                $projectId,

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

            'project',

            $projectId
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

                    'projects'
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

                'project',

                $projectId,

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

            'Project created successfully.'
        );

        return $response->redirect(

            url('dashboard/projects')
        );
    }

     /**
     * Edit project form
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
        Authorization::authorize('projects.edit');

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch project
         */
        $project =
            Project::find($id);

            /**
             * Original project
             * for audit logging
             */
            $oldProject =
                $project;

        /**
         * Project not found
         */
        if (!$project) {

            return $response->notFound(
                'Project not found.'
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

            'project',

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

            'project',

            $id
        ]);

        $media =
            $mediaQuery->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.projects.edit',

            [

                'project' =>
                    $project,

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
     * Update project
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
        Authorization::authorize('projects.edit');

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch project
         */
        $project =
            Project::find($id);

            /**
         * Original project
         * for audit logging
         */
        $oldProject =
            $project;

        /**
         * Project not found
         */
        if (!$project) {

            return $response->notFound(
                'Project not found.'
            );
        }

        /**
         * Validate request
         */
        $validator = Validator::make(

            $_POST,

            [

                'title' => 'required|max:255',

                'category_id' => 'required|exists:categories,id',

                'images' => 'sometimes|array|min:1',

                'status' => 'required|in:active,inactive'

            ]

        );

        if ($validator->fails()) {

            Flash::set(

                'danger',

                implode('<br>', $validator->all())
            );

            return $response->redirect(

                url('dashboard/projects/edit/' . $id)
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
                FROM projects
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
         * Update project
         */
        $query =
            $db->prepare("

                UPDATE projects

                SET

                    title = ?,
                    slug = ?,
                    client_name = ?,
                    scope = ?,
                    impact = ?,
                    meta_title = ?,
                    meta_description = ?,
                    meta_keywords = ?,
                    featured = ?,
                    completion_date = ?,
                    status = ?,
                    updated_by = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        $query->execute([

            $_POST['title'],

            $slug,

            $_POST['client_name']
                ??
                null,

            $_POST['scope']
                ??
                null,

            $_POST['impact']
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

            $_POST['completion_date']
                ??
                null,

            $_POST['status'],

            Auth::id(),

            $id
        ]);

        /**
         * Status changed
         */
        if (

            $oldProject['status']

            !=

            $_POST['status']

        ) {

            AuditLog::log(

                'status_changed',

                'projects',

                $id,

                [

                    'status' =>
                        $oldProject['status']

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

            $oldProject['featured']

            !=

            (
                isset($_POST['featured'])
                    ? 1
                    : 0
            )

        ) {

            AuditLog::log(

                'featured_changed',

                'projects',

                $id,

                [

                    'featured' =>
                        $oldProject['featured']

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
         * Category changed
         */
        $categoryCheck =
            $db->prepare(

                "
                SELECT category_id
                FROM categoryables
                WHERE categoryable_type = ?
                AND categoryable_id = ?
                LIMIT 1
                "
            );

        $categoryCheck->execute([

            'project',

            $id
        ]);

        $oldCategory =
            $categoryCheck->fetch();

        if (

            $oldCategory

            &&

            $oldCategory['category_id']

            !=

            $_POST['category_id']

        ) {

            AuditLog::log(

                'category_changed',

                'projects',

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
         * Update category
         */
        $deleteCategory =
            $db->prepare("

                DELETE FROM categoryables

                WHERE categoryable_type = ?
                AND categoryable_id = ?

            ");

        $deleteCategory->execute([

            'project',

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

            'project',

            $id
        ]);

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

                'project',

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

                'project',

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

                        'projects'
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

                    'project',

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

                    'project',

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

            'project',

            $id
        ]);

        $remaining =
            $imageCheck->fetch();

        if ($remaining['total'] < 1) {

            return $response->send(
                'A project must have at least one image.'
            );
        }

        /**
         * Audit log
         */
        AuditLog::log(

            'update',

            'projects',

            $id,

            [

                'title' =>
                    $oldProject['title'],

                'slug' =>
                    $oldProject['slug'],

                'featured' =>
                    $oldProject['featured'],

                'status' =>
                    $oldProject['status']

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

        AuditLog::log(
            'media_added',
            'projects',
            $id
        );

        AuditLog::log(
            'media_deleted',
            'projects',
            $id
        );

        AuditLog::log(
            'featured_image_changed',
            'projects',
            $id
        );

        Flash::set(

            'success',

            'Project updated successfully.'
        );
        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/projects')
        );
    }
}