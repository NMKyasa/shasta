<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Core\Database\Connection;

class ProjectController extends BaseController
{
    /**
     * Projects Listing
     */
    public function index(
        $request,
        $response
    )
    {
        $db =
            Connection::getInstance();

        /**
         * Categories
         */
        $categories =
            $db->query(
                "
                SELECT *
                FROM categories
                WHERE status = 'active'
                AND deleted_at IS NULL
                ORDER BY name ASC
                "
            )->fetchAll();

        /**
         * Projects
         */
        $projects =
            $db->query(
                "
                SELECT

                    p.*,

                    c.name AS category_name,

                    c.slug AS category_slug,

                    m.file_path

                FROM projects p

                LEFT JOIN categoryables ca

                    ON ca.categoryable_id = p.id

                    AND ca.categoryable_type = 'project'

                LEFT JOIN categories c

                    ON c.id = ca.category_id

                LEFT JOIN media m

                    ON m.mediable_type = 'project'

                    AND m.mediable_id = p.id

                    AND m.is_featured = 1

                    AND m.status = 'active'

                    AND m.deleted_at IS NULL

                WHERE p.status = 'active'

                AND p.deleted_at IS NULL

                ORDER BY p.id DESC
                "
            )->fetchAll();

        return $this->view(

            'frontend.projects.index',

            [

                'projects' => $projects,

                'categories' => $categories,

                'pageHeaderTitle' => 'Our Projects'

            ],

            'layouts.frontend'
        );
    }

    /**
     * Project Details
     */
    public function show(
        $request,
        $response,
        $slug
    )
    {
        $db =
            Connection::getInstance();

        /**
         * Project
         */
        $query =
            $db->prepare(
                "
                SELECT

                    p.*,

                    c.name AS category_name,

                    c.slug AS category_slug,

                    m.file_path AS featured_image

                FROM projects p

                LEFT JOIN categoryables ca

                    ON ca.categoryable_id = p.id

                    AND ca.categoryable_type = 'project'

                LEFT JOIN categories c

                    ON c.id = ca.category_id

                LEFT JOIN media m

                    ON m.mediable_type = 'project'

                    AND m.mediable_id = p.id

                    AND m.is_featured = 1

                    AND m.status = 'active'

                    AND m.deleted_at IS NULL

                WHERE p.slug = ?

                AND p.status = 'active'

                AND p.deleted_at IS NULL

                LIMIT 1
                "
            );

        $query->execute([$slug]);

        $project = $query->fetch();

        if (!$project) {

            return $response->notFound(
                'Project not found.'
            );
        }

        /**
         * Gallery Images
         * Exclude the featured image so it doesn't appear twice.
         */
        $galleryQuery =
            $db->prepare(
                "
                SELECT *
                FROM media
                WHERE mediable_type = 'project'
                AND mediable_id = ?
                AND is_featured = 0
                AND status = 'active'
                AND deleted_at IS NULL
                ORDER BY sort_order ASC
                "
            );

        $galleryQuery->execute([$project['id']]);

        $gallery = $galleryQuery->fetchAll();

        /**
         * Previous Project
         * The project immediately before this one (lower ID), active only.
         */
        $prevQuery =
            $db->prepare(
                "
                SELECT

                    p.id,

                    p.slug,

                    p.title,

                    c.name AS category_name,

                    m.file_path

                FROM projects p

                LEFT JOIN categoryables ca

                    ON ca.categoryable_id = p.id

                    AND ca.categoryable_type = 'project'

                LEFT JOIN categories c

                    ON c.id = ca.category_id

                LEFT JOIN media m

                    ON m.mediable_type = 'project'

                    AND m.mediable_id = p.id

                    AND m.is_featured = 1

                    AND m.status = 'active'

                    AND m.deleted_at IS NULL

                WHERE p.id < ?

                AND p.status = 'active'

                AND p.deleted_at IS NULL

                ORDER BY p.id DESC

                LIMIT 1
                "
            );

        $prevQuery->execute([$project['id']]);

        $prev_project = $prevQuery->fetch();

        /**
         * Next Project
         * The project immediately after this one (higher ID), active only.
         */
        $nextQuery =
            $db->prepare(
                "
                SELECT

                    p.id,

                    p.slug,

                    p.title,

                    c.name AS category_name,

                    m.file_path

                FROM projects p

                LEFT JOIN categoryables ca

                    ON ca.categoryable_id = p.id

                    AND ca.categoryable_type = 'project'

                LEFT JOIN categories c

                    ON c.id = ca.category_id

                LEFT JOIN media m

                    ON m.mediable_type = 'project'

                    AND m.mediable_id = p.id

                    AND m.is_featured = 1

                    AND m.status = 'active'

                    AND m.deleted_at IS NULL

                WHERE p.id > ?

                AND p.status = 'active'

                AND p.deleted_at IS NULL

                ORDER BY p.id ASC

                LIMIT 1
                "
            );

        $nextQuery->execute([$project['id']]);

        $next_project = $nextQuery->fetch();

        return $this->view(

            'frontend.projects.show',

            [

                'project'      => $project,

                'gallery'      => $gallery,

                'prev_project' => $prev_project,

                'next_project' => $next_project,

                'pageHeaderTitle' =>
                    $project['title'],

                /**
                 * SEO
                 */
                'title' =>
                    $project['meta_title']
                    ?: $project['title'],

                'description' =>
                    $project['meta_description'],

                'keywords' =>
                    $project['meta_keywords']

            ],

            'layouts.frontend'
        );
    }
}