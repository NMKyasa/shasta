<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Core\Database\Connection;

class TestimonialController extends BaseController
{
    public function index(
        $request,
        $response
    )
    {
        $db =
            Connection::getInstance();

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

        return $this->view(
            'frontend.testimonials.index',
            [
                'pageHeaderTitle' => 'Testimonials',
                'testimonials' => $testimonials
            ],
            'layouts.frontend'
        );
    }
}