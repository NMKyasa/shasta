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
             * Projects
             */
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

                    LIMIT 6
                    "
                )->fetchAll();

                /**
                 * Settings
                 */
                $settings = [];

                $query =
                    $db->query(
                        "
                        SELECT
                            setting_key,
                            setting_value
                        FROM settings
                        "
                    );

                foreach (
                    $query->fetchAll()
                    as
                    $setting
                ) {

                    $settings[
                        $setting['setting_key']
                    ] =
                        $setting['setting_value'];
                }

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

                'services' => $services,

                'projects' => $projects,

                'settings' => $settings,

                'teamMembers' => $teamMembers,

                'testimonials' => $testimonials

            ],

            'layouts.frontend'
        );
    }
}