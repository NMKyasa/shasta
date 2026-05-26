<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database\Connection;

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
         * Services count
         */
        $services =
            $db->query("

                SELECT COUNT(*) AS total
                FROM services
                WHERE deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Projects count
         */
        $projects =
            $db->query("

                SELECT COUNT(*) AS total
                FROM projects
                WHERE deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Team members count
         */
        $teamMembers =
            $db->query("

                SELECT COUNT(*) AS total
                FROM team_members
                WHERE deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Testimonials count
         */
        $testimonials =
            $db->query("

                SELECT COUNT(*) AS total
                FROM testimonials
                WHERE deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Pricing items count
         */
        $pricingItems =
            $db->query("

                SELECT COUNT(*) AS total
                FROM pricing_items
                WHERE deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Categories count
         */
        $categories =
            $db->query("

                SELECT COUNT(*) AS total
                FROM categories
                WHERE deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Active services
         */
        $activeServices =
            $db->query("

                SELECT COUNT(*) AS total
                FROM services
                WHERE status = 'active'
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Active projects
         */
        $activeProjects =
            $db->query("

                SELECT COUNT(*) AS total
                FROM projects
                WHERE status = 'active'
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Active team members
         */
        $activeTeamMembers =
            $db->query("

                SELECT COUNT(*) AS total
                FROM team_members
                WHERE status = 'active'
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Active testimonials
         */
        $activeTestimonials =
            $db->query("

                SELECT COUNT(*) AS total
                FROM testimonials
                WHERE status = 'active'
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Active pricing
         */
        $activePricing =
            $db->query("

                SELECT COUNT(*) AS total
                FROM pricing_items
                WHERE status = 'active'
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Featured services
         */
        $featuredServices =
            $db->query("

                SELECT COUNT(*) AS total
                FROM services
                WHERE featured = 1
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Featured projects
         */
        $featuredProjects =
            $db->query("

                SELECT COUNT(*) AS total
                FROM projects
                WHERE featured = 1
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Featured team members
         */
        $featuredTeamMembers =
            $db->query("

                SELECT COUNT(*) AS total
                FROM team_members
                WHERE featured = 1
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Featured testimonials
         */
        $featuredTestimonials =
            $db->query("

                SELECT COUNT(*) AS total
                FROM testimonials
                WHERE featured = 1
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Featured pricing
         */
        $featuredPricing =
            $db->query("

                SELECT COUNT(*) AS total
                FROM pricing_items
                WHERE featured = 1
                AND deleted_at IS NULL

            ")->fetch()['total'];

        /**
         * Statistics array
         */
        $statistics = [

            'services' =>
                $services,

            'projects' =>
                $projects,

            'team_members' =>
                $teamMembers,

            'testimonials' =>
                $testimonials,

            'pricing_items' =>
                $pricingItems,

            'categories' =>
                $categories,

            'active_content' =>

                $activeServices
                +
                $activeProjects
                +
                $activeTeamMembers
                +
                $activeTestimonials
                +
                $activePricing,

            'featured_content' =>

                $featuredServices
                +
                $featuredProjects
                +
                $featuredTeamMembers
                +
                $featuredTestimonials
                +
                $featuredPricing
        ];

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