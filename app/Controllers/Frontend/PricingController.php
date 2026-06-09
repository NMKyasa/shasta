<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Core\Database\Connection;

class PricingController extends BaseController
{
    public function index(
        $request,
        $response
    )
    {
        $db =
            Connection::getInstance();

        $pricingItems =
            $db->query(
                "
                SELECT

                    pricing_items.*,

                    services.title
                    AS service_title

                FROM pricing_items

                LEFT JOIN services

                    ON services.id = pricing_items.service_id

                WHERE pricing_items.status = 'active'

                AND pricing_items.deleted_at IS NULL

                ORDER BY

                    pricing_items.featured DESC,

                    pricing_items.sort_order ASC,

                    pricing_items.id ASC
                "
            )->fetchAll();

        return $this->view(

            'frontend.pricing.index',

            [

                'pricingItems' => $pricingItems,

                'pageHeaderTitle' => 'Pricing'

            ],

            'layouts.frontend'
        );
    }
}