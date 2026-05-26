<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Pricing;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Services\Auth;

class PricingController
extends BaseController
{
    /**
     * Pricing items listing
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
         * Fetch pricing items
         */
        $query =
            $db->query("

                SELECT

                    pricing_items.*,

                    services.title
                    AS service_title

                FROM pricing_items

                LEFT JOIN services
                ON services.id = pricing_items.service_id

                ORDER BY pricing_items.id DESC

            ");

        /**
         * Pricing items results
         */
        $pricingItems =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.pricing.index',

            [

                'pricingItems' =>
                    $pricingItems
            ],

            'layouts.admin'
        );
    }

    /**
     * Show create form
     */
    public function create(
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
         * Fetch services
         */
        $servicesQuery =
            $db->query("

                SELECT

                    id,
                    title

                FROM services

                WHERE status = 'active'

                ORDER BY title ASC

            ");

        /**
         * Services results
         */
        $services =
            $servicesQuery->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.pricing.create',

            [

                'services' =>
                    $services
            ],

            'layouts.admin'
        );
    }

    /**
     * Store pricing item
     */
    public function store(
        $request,
        $response
    )
    {
        /**
         * Service ID
         */
        $serviceId =
            $_POST['service_id']
            ?? null;

        /**
         * Pricing title
         */
        $title =
            trim(
                $_POST['title']
                ?? ''
            );

        /**
         * Subtitle
         */
        $subtitle =
            trim(
                $_POST['subtitle']
                ?? ''
            );

        /**
         * Pricing type
         */
        $pricingType =
            $_POST['pricing_type']
            ?? 'fixed';

        /**
         * Price
         */
        $price =
            $_POST['price']
            ?? null;

        /**
         * Currency
         */
        $currency =
            trim(
                $_POST['currency']
                ?? 'UGX'
            );

        /**
         * Pricing period
         */
        $pricingPeriod =
            trim(
                $_POST['pricing_period']
                ?? ''
            );

        /**
         * Description
         */
        $description =
            trim(
                $_POST['description']
                ?? ''
            );

        /**
         * Featured status
         */
        $featured =
            isset($_POST['featured'])
                ? 1
                : 0;

        /**
         * Sort order
         */
        $sortOrder =
            $_POST['sort_order']
            ?? 0;

        /**
         * Status
         */
        $status =
            $_POST['status']
            ?? 'active';

        /**
         * Validate service
         */
        if (empty($serviceId)) {

            Flash::set(

                'danger',

                'Please select a service.'
            );

            return $response->redirect(

                url(
                    'dashboard/pricing/create'
                )
            );
        }

        /**
         * Validate title
         */
        if (empty($title)) {

            Flash::set(

                'danger',

                'Pricing title is required.'
            );

            return $response->redirect(

                url(
                    'dashboard/pricing/create'
                )
            );
        }

        /**
         * Validate pricing type
         */
        if (

            !in_array(

                $pricingType,

                [

                    'fixed',

                    'negotiable'
                ]
            )
        ) {

            Flash::set(

                'danger',

                'Invalid pricing type.'
            );

            return $response->redirect(

                url(
                    'dashboard/pricing/create'
                )
            );
        }

        /**
         * Validate price
         */
        if (

            $pricingType === 'fixed'

            &&

            (
                empty($price)
                ||
                !is_numeric($price)
            )
        ) {

            Flash::set(

                'danger',

                'A valid price is required.'
            );

            return $response->redirect(

                url(
                    'dashboard/pricing/create'
                )
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Insert pricing item
         */
        $query =
            $db->prepare("

                INSERT INTO pricing_items (

                    service_id,
                    title,
                    subtitle,
                    price,
                    currency,
                    pricing_type,
                    pricing_period,
                    description,
                    featured,
                    sort_order,
                    status,
                    created_by,
                    updated_by,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                )

            ");

        /**
         * Execute insert
         */
        $query->execute([

            $serviceId,

            $title,

            $subtitle,

            $pricingType === 'negotiable'
                ? null
                : $price,

            $currency,

            $pricingType,

            $pricingPeriod,

            $description,

            $featured,

            $sortOrder,

            $status,

            Auth::id(),

            Auth::id()
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Pricing item created successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/pricing')
        );
    }

    /**
     * Edit pricing item
     */
    public function edit(
        $request,
        $response,
        $id
    )
    {
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch pricing item
         */
        $query =
            $db->prepare("

                SELECT *
                FROM pricing_items
                WHERE id = ?
                LIMIT 1

            ");

        $query->execute([$id]);

        /**
         * Pricing item result
         */
        $pricingItem =
            $query->fetch();

        /**
         * Pricing item not found
         */
        if (!$pricingItem) {

            Flash::set(

                'danger',

                'Pricing item not found.'
            );

            return $response->redirect(

                url('dashboard/pricing')
            );
        }

        /**
         * Fetch services
         */
        $servicesQuery =
            $db->query("

                SELECT

                    id,
                    title

                FROM services

                WHERE status = 'active'

                ORDER BY title ASC

            ");

        /**
         * Services results
         */
        $services =
            $servicesQuery->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.pricing.edit',

            [

                'pricingItem' =>
                    $pricingItem,

                'services' =>
                    $services
            ],

            'layouts.admin'
        );
    }

    /**
     * Update pricing item
     */
    public function update(
        $request,
        $response,
        $id
    )
    {
        /**
         * Service ID
         */
        $serviceId =
            $_POST['service_id']
            ?? null;

        /**
         * Pricing title
         */
        $title =
            trim(
                $_POST['title']
                ?? ''
            );

        /**
         * Subtitle
         */
        $subtitle =
            trim(
                $_POST['subtitle']
                ?? ''
            );

        /**
         * Pricing type
         */
        $pricingType =
            $_POST['pricing_type']
            ?? 'fixed';

        /**
         * Price
         */
        $price =
            $_POST['price']
            ?? null;

        /**
         * Currency
         */
        $currency =
            trim(
                $_POST['currency']
                ?? 'UGX'
            );

        /**
         * Pricing period
         */
        $pricingPeriod =
            trim(
                $_POST['pricing_period']
                ?? ''
            );

        /**
         * Description
         */
        $description =
            trim(
                $_POST['description']
                ?? ''
            );

        /**
         * Featured status
         */
        $featured =
            isset($_POST['featured'])
                ? 1
                : 0;

        /**
         * Sort order
         */
        $sortOrder =
            $_POST['sort_order']
            ?? 0;

        /**
         * Status
         */
        $status =
            $_POST['status']
            ?? 'active';

        /**
         * Validate service
         */
        if (empty($serviceId)) {

            Flash::set(

                'danger',

                'Please select a service.'
            );

            return $response->redirect(

                url(

                    'dashboard/pricing/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Validate title
         */
        if (empty($title)) {

            Flash::set(

                'danger',

                'Pricing title is required.'
            );

            return $response->redirect(

                url(

                    'dashboard/pricing/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Validate price
         */
        if (

            $pricingType === 'fixed'

            &&

            (
                empty($price)
                ||
                !is_numeric($price)
            )
        ) {

            Flash::set(

                'danger',

                'A valid price is required.'
            );

            return $response->redirect(

                url(

                    'dashboard/pricing/edit/'
                    .
                    $id
                )
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Update pricing item
         */
        $query =
            $db->prepare("

                UPDATE pricing_items

                SET

                    service_id = ?,
                    title = ?,
                    subtitle = ?,
                    price = ?,
                    currency = ?,
                    pricing_type = ?,
                    pricing_period = ?,
                    description = ?,
                    featured = ?,
                    sort_order = ?,
                    status = ?,
                    updated_by = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        /**
         * Execute update
         */
        $query->execute([

            $serviceId,

            $title,

            $subtitle,

            $pricingType === 'negotiable'
                ? null
                : $price,

            $currency,

            $pricingType,

            $pricingPeriod,

            $description,

            $featured,

            $sortOrder,

            $status,

            Auth::id(),

            $id
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Pricing item updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/pricing')
        );
    }
}