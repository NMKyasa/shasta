<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Inquiry;
use App\Core\Database\Connection;
use App\Core\Services\Flash;

class InquiryController
extends BaseController
{
    /**
     * Inquiries listing
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
         * Selected filter
         */
        $type =
            $_GET['type']
            ??
            null;

        /**
         * Base query
         */
        $sql = "

            SELECT

                inquiries.*,

                services.title
                AS service_title,

                projects.title
                AS project_title

            FROM inquiries

            LEFT JOIN services

                ON services.id = inquiries.service_id

            LEFT JOIN projects

                ON projects.id = inquiries.project_id

            WHERE 1=1

        ";

        /**
         * Query bindings
         */
        $bindings = [];

        /**
         * Filter by inquiry type
         */
        if ($type) {

            $sql .= "

                AND inquiries.inquiry_type = ?

            ";

            $bindings[] =
                $type;
        }

        /**
         * Order results
         */
        $sql .= "

            ORDER BY
                inquiries.created_at DESC

        ";

        /**
         * Prepare query
         */
        $query =
            $db->prepare($sql);

        $query->execute($bindings);

        /**
         * Fetch inquiries
         */
        $inquiries =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.inquiries.index',

            [

                'inquiries' =>
                    $inquiries,

                'selectedType' =>
                    $type
            ],

            'layouts.admin'
        );
    }

    /**
     * Show inquiry details
     */
    public function show(
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
         * Fetch inquiry
         */
        $query =
            $db->prepare("

                SELECT

                    inquiries.*,

                    services.title
                    AS service_title,

                    projects.title
                    AS project_title

                FROM inquiries

                LEFT JOIN services

                    ON services.id = inquiries.service_id

                LEFT JOIN projects

                    ON projects.id = inquiries.project_id

                WHERE inquiries.id = ?

                LIMIT 1

            ");

        $query->execute([$id]);

        /**
         * Inquiry data
         */
        $inquiry =
            $query->fetch();

        /**
         * Inquiry not found
         */
        if (!$inquiry) {

            return $response->notFound(

                'Inquiry not found.'
            );
        }

        /**
         * Render page
         */
        $this->view(

            'admin.inquiries.show',

            [

                'inquiry' =>
                    $inquiry
            ],

            'layouts.admin'
        );
    }

    /**
     * Update inquiry status
     */
    public function updateStatus(
        $request,
        $response,
        $id
    )
    {
        /**
         * Status
         */
        $status =
            $_POST['status']
            ??
            null;

        /**
         * Allowed statuses
         */
        $allowedStatuses = [

            'new',

            'in_progress',

            'resolved',

            'closed'
        ];

        /**
         * Validate status
         */
        if (

            !$status

            ||

            !in_array(

                $status,

                $allowedStatuses
            )
        ) {

            Flash::set(

                'danger',

                'Invalid inquiry status.'
            );

            return $response->redirect(

                url(
                    'dashboard/inquiries/show/'
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
         * Check inquiry exists
         */
        $checkQuery =
            $db->prepare("

                SELECT id
                FROM inquiries
                WHERE id = ?
                LIMIT 1

            ");

        $checkQuery->execute([$id]);

        /**
         * Inquiry not found
         */
        if (
            !$checkQuery->fetch()
        ) {

            return $response->notFound(

                'Inquiry not found.'
            );
        }

        /**
         * Update status
         */
        $query =
            $db->prepare("

                UPDATE inquiries

                SET

                    status = ?,
                    admin_notes = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        $query->execute([

            $status,

            $_POST['admin_notes']
                ??
                null,

            $id
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Inquiry updated successfully.'
        );

        /**
         * Redirect back
         */
        return $response->redirect(

            url(
                'dashboard/inquiries/show/'
                .
                $id
            )
        );
    }
}