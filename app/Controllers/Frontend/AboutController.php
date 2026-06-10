<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Core\Database\Connection;

class AboutController extends BaseController
{
    public function index(
        $request,
        $response
    )
    {
            $db =
                Connection::getInstance();

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

            // IMPACT 
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
         * About image
         */
        $query =
            $db->query(
                "
                SELECT file_path

                FROM media

                WHERE mediable_type = 'setting'

                AND is_featured = 1

                AND status = 'active'

                AND deleted_at IS NULL

                LIMIT 1
                "
            );

        $aboutImage =
            $query->fetch();

            return $this->view(
                'frontend.about.index',
                [
                    'pageHeaderTitle' => 'About Us',
                    'aboutImage' => $aboutImage,
                    'impacts' => $impacts,
                    'settings' => $settings
                ],
                'layouts.frontend'
            );

    }
}