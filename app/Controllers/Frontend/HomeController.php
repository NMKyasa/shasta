<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Core\Database\Connection;

/**
 * Homepage Controller
 */
class HomeController extends BaseController
{
    /**
     * Homepage
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
         * Sliders
         */
        $sliders =
            $db->query(
                "
                SELECT

                    s.*,

                    m.file_path

                FROM sliders s

                LEFT JOIN media m

                    ON m.mediable_type = 'slider'

                    AND m.mediable_id = s.id

                    AND m.is_featured = 1

                    AND m.status = 'active'

                    AND m.deleted_at IS NULL

                WHERE s.status = 'active'

                AND s.deleted_at IS NULL

                ORDER BY s.sort_order ASC
                "
            )->fetchAll();


            // IMPACTS
            $impacts =
                $db->query(
                    "
                    SELECT *
                    FROM impacts
                    WHERE status = 'active'
                    AND deleted_at IS NULL
                    ORDER BY sort_order ASC
                    "
                )->fetchAll();

        /**
         * Services
         */
        $services =
            $db->query(
                "
                SELECT

                    s.*,

                    m.file_path

                FROM services s

                LEFT JOIN media m

                    ON m.mediable_type = 'service'

                    AND m.mediable_id = s.id

                    AND m.is_featured = 1

                    AND m.status = 'active'

                    AND m.deleted_at IS NULL

                WHERE s.status = 'active'

                AND s.deleted_at IS NULL

                ORDER BY s.id DESC
                "
            )->fetchAll();

            /**
             * Project Categories
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

                    LIMIT 6
                    "
                )->fetchAll();

                // Team members
                $teamMembers =
                    $db->query(
                        "
                        SELECT

                            tm.*,

                            m.file_path

                        FROM team_members tm

                        LEFT JOIN media m

                            ON m.mediable_type = 'team_member'

                            AND m.mediable_id = tm.id

                            AND m.is_featured = 1

                            AND m.status = 'active'

                            AND m.deleted_at IS NULL

                        WHERE tm.status = 'active'

                        AND tm.deleted_at IS NULL

                        ORDER BY tm.sort_order ASC
                        "
                    )->fetchAll();

                    // Testimonials
                    $testimonials =
                        $db->query(
                            "
                            SELECT

                                t.*,

                                m.file_path

                            FROM testimonials t

                            LEFT JOIN media m

                                ON m.mediable_type = 'testimonials'

                                AND m.mediable_id = t.id

                                AND m.is_featured = 1

                                AND m.status = 'active'

                                AND m.deleted_at IS NULL

                            WHERE t.status = 'active'

                            AND t.deleted_at IS NULL

                            ORDER BY

                                t.featured DESC,

                                t.sort_order ASC
                            "
                        )->fetchAll();

        /**
         * Render homepage
         */
        return $this->view(

            'frontend.home.index',

            [

                'sliders'  => $sliders,

                'impacts' => $impacts,

                'services' => $services,

                'categories' => $categories,

                'projects' => $projects,

                'teamMembers' => $teamMembers,

                'testimonials' => $testimonials

            ],

            'layouts.frontend'
        );
    }
}