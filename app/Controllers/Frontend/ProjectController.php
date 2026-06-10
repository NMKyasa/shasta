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

        $query =
            $db->prepare(
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

                WHERE p.slug = ?

                AND p.status = 'active'

                AND p.deleted_at IS NULL

                LIMIT 1
                "
            );

        $query->execute([
            $slug
        ]);

        $project =
            $query->fetch();

        if (!$project) {

            return $response->notFound(
                'Project not found.'
            );
        }

        return $this->view(

            'frontend.projects.show',

            [

                'project' => $project,

                'pageHeaderTitle' => $project['title']

            ],

            'layouts.frontend'
        );
    }
}