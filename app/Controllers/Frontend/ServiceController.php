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
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch services with featured image
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

                ORDER BY s.title ASC
                "
            )->fetchAll();

        /**
         * Render page
         */
        return $this->view(

            'frontend.services.index',

            [

                'services' =>
                    $services,

                'pageHeaderTitle' =>
                    'Services'

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
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch service
         */
        $query =
            $db->prepare(
                "
                SELECT *
                FROM services
                WHERE slug = ?
                AND status = 'active'
                AND deleted_at IS NULL
                LIMIT 1
                "
            );

        $query->execute([
            $slug
        ]);

        /**
         * Service data
         */
        $service =
            $query->fetch();

        /**
         * Service not found
         */
        if (
            !$service
        ) {

            abort(404);
        }

        /**
         * Fetch all service images
         */
        $mediaQuery =
            $db->prepare(
                "
                SELECT *
                FROM media
                WHERE mediable_type = 'service'
                AND mediable_id = ?
                AND status = 'active'
                AND deleted_at IS NULL
                ORDER BY

                    is_featured DESC,

                    id ASC
                "
            );

        $mediaQuery->execute([

            $service['id']

        ]);

        /**
         * Service gallery images
         */
        $images =
            $mediaQuery->fetchAll();

        /**
         * Render page
         */
        return $this->view(

            'frontend.services.show',

            [

                /**
                 * Service data
                 */
                'service' =>
                    $service,

                /**
                 * Gallery images
                 */
                'images' =>
                    $images,

                /**
                 * Page Header
                 */
                'pageHeaderTitle' =>
                    $service['title'],

                /**
                 * SEO
                 */
                'title' =>

                    !empty(
                        $service['meta_title']
                    )

                    ?

                    $service['meta_title']

                    :

                    $service['title'],

                'description' =>

                    !empty(
                        $service['meta_description']
                    )

                    ?

                    $service['meta_description']

                    :

                    $service['summary'],

                'keywords' =>

                    $service['meta_keywords']
                    ??
                    '',

                'canonicalUrl' =>

                    $service['canonical_url']
                    ??
                    ''

            ],

            'layouts.frontend'
        );
    }
}