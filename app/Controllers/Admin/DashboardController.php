<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database\Connection;
use App\Core\Auth\Authorization;

class DashboardController
extends BaseController
{
    /**
     * Dashboard
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
         * Dashboard statistics
         */
        $statistics = [];

        /**
         * Services
         */
        if (
            Authorization::can(
                'services.view'
            )
        ) {

            $statistics['services'] =
                $db->query(
                    "
                    SELECT COUNT(*) AS total
                    FROM services
                    WHERE deleted_at IS NULL
                    "
                )->fetch()['total'];
        }

        /**
         * Projects
         */
        if (
            Authorization::can(
                'projects.view'
            )
        ) {

            $statistics['projects'] =
                $db->query(
                    "
                    SELECT COUNT(*) AS total
                    FROM projects
                    WHERE deleted_at IS NULL
                    "
                )->fetch()['total'];
        }

        /**
         * Team Members
         */
        if (
            Authorization::can(
                'team_members.view'
            )
        ) {

            $statistics['team_members'] =
                $db->query(
                    "
                    SELECT COUNT(*) AS total
                    FROM team_members
                    WHERE deleted_at IS NULL
                    "
                )->fetch()['total'];
        }

        /**
         * Testimonials
         */
        if (
            Authorization::can(
                'testimonials.view'
            )
        ) {

            $statistics['testimonials'] =
                $db->query(
                    "
                    SELECT COUNT(*) AS total
                    FROM testimonials
                    WHERE deleted_at IS NULL
                    "
                )->fetch()['total'];
        }

        /**
         * Inquiries
         */
        if (
            Authorization::can(
                'inquiries.view'
            )
        ) {

            $statistics['inquiries'] =
                $db->query(
                    "
                    SELECT COUNT(*) AS total
                    FROM inquiries
                    "
                )->fetch()['total'];
        }

        /**
         * Pricing
         */
        if (
            Authorization::can(
                'pricing_items.view'
            )
        ) {

            $statistics['pricing_items'] =
                $db->query(
                    "
                    SELECT COUNT(*) AS total
                    FROM pricing_items
                    WHERE deleted_at IS NULL
                    "
                )->fetch()['total'];
        }

        /**
         * Categories
         */
        if (
            Authorization::can(
                'categories.view'
            )
        ) {

            $statistics['categories'] =
                $db->query(
                    "
                    SELECT COUNT(*) AS total
                    FROM categories
                    WHERE deleted_at IS NULL
                    "
                )->fetch()['total'];
        }

        /**
         * Users
         */
        if (
            Authorization::can(
                'users.view'
            )
        ) {

            $statistics['users'] =
                $db->query(
                    "
                    SELECT COUNT(*) AS total
                    FROM users
                    "
                )->fetch()['total'];
        }

        /**
         * Roles
         */
        if (
            Authorization::can(
                'roles.view'
            )
        ) {

            $statistics['roles'] =
                $db->query(
                    "
                    SELECT COUNT(*) AS total
                    FROM roles
                    WHERE deleted_at IS NULL
                    "
                )->fetch()['total'];
        }
        
        /**
         * Render dashboard
         */
        $this->view(

            'admin.dashboard.index',

            [

                'statistics' =>
                    $statistics
            ],

            'layouts.admin'
        );
    }
}