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

        $projects =
            $db->query(
                "
                SELECT

                    p.*,

                    m.file_path

                FROM projects p

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

                    m.file_path

                FROM projects p

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