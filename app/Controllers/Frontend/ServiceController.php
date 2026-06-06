<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Core\Database\Connection;

class ServiceController extends BaseController
{
    /**
     * Services Listing
     */
    public function index(
        $request,
        $response
    )
    {
        $db =
            Connection::getInstance();

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

                ORDER BY s.title ASC
                "
            )->fetchAll();

        return $this->view(

            'frontend.services.index',

            [

                'services' => $services

            ],

            'layouts.frontend'
        );
    }

    /**
     * Service Details
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

                    s.*,

                    m.file_path

                FROM services s

                LEFT JOIN media m

                    ON m.mediable_type = 'service'

                    AND m.mediable_id = s.id

                    AND m.is_featured = 1

                    AND m.status = 'active'

                    AND m.deleted_at IS NULL

                WHERE s.slug = ?

                AND s.status = 'active'

                AND s.deleted_at IS NULL

                LIMIT 1
                "
            );

        $query->execute([
            $slug
        ]);

        $service =
            $query->fetch();

        if (
            !$service
        ) {

            abort(404);
        }

        return $this->view(

            'frontend.services.show',

            [

                'service' => $service

            ],

            'layouts.frontend'
        );
    }
    
}