<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Validation\Validator;
use App\Core\Auth\Authorization;
use App\Core\Services\AuditLog;

class ImpactController
extends BaseController
{
    /**
     * Impact listing
     */
    public function index(
        $request,
        $response
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('impacts.view');

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch impacts
         */
        $query =
            $db->query("

                SELECT *
                FROM impacts
                ORDER BY id DESC

            ");

        /**
         * Impacts results
         */
        $impact =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.impact.index',

            [

                'impact' =>
                    $impact
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
         * Check authorization
         */
        Authorization::authorize('impacts.create');

        /**
         * Render page
         */
        $this->view(

            'admin.impact.create',

            [],

            'layouts.admin'
        );
    }

    /**
     * Store impact
     */
    public function store(
        $request,
        $response
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('impacts.create');

        // Impact label
        $label = 
        trim(
            $_POST['label']
            ??
            ''
        );

            // Impact value
            $value =
            trim(
                $_POST['value']
                ??
                ''
            );


            //validate request
            $validator = Validator::make(

                $_POST,

                [

                    'label' => 'required|max:255',

                    'value' => 'required|numeric',

                    'status' => 'required|in:active,inactive'
                ]
            );
            if ($validator->fails()) {

                Flash::set(

                    'danger',

                    implode('<br>', $validator->all())
                );

                return $response->redirect(

                    url('dashboard/impact/create')
                );
            }


        /**
         * Impact status
         */
        $status =
            $_POST['status']
            ??
            'active';


        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Ensure unique slug
         */
        // $slugCheck =
        //     $db->prepare("

        //         SELECT id
        //         FROM impacts
        //         WHERE slug = ?
        //         LIMIT 1

        //     ");

        // $slugCheck->execute([$slug]);

        /**
         * Append timestamp if slug exists
         */
        // if ($slugCheck->fetch()) {

        //     $slug .= '-'
        //         .
        //         time();
        // }

        /**
         * Insert impact
         */
        $query =
            $db->prepare("

                INSERT INTO impacts (

                    label,
                    value,
                    sort_order,
                    status,
                    created_at,
                    updated_at

                )

                VALUES (

                        ?, ?, ?, ?, NOW(), NOW()

                )

            ");

        /**
         * Execute insert
         */
        $query->execute([

            $label,

            $value,

            $_POST['sort_order'] ?? 0,

            $status
        ]);

        /**
         * Audit log
         */
        AuditLog::log(

            'create',

            'impacts',

            $db->lastInsertId(),

            null,

            [

                'label' =>
                    $label,

                'value' =>
                    $value,

                    'sort_order' =>
                        $_POST['sort_order'] ?? 0,

                'status' =>
                    $status

            ]
        );

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Impact created successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/impact')
        );
    }

    /**
     * Edit impact form
     */
    public function edit(
        $request,
        $response,
        $id
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('impacts.edit');

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch impact
         */
        $query =
            $db->prepare("

                SELECT *
                FROM impacts
                WHERE id = ?
                LIMIT 1

            ");

        $query->execute([$id]);

        /**
         * Impact result
         */
        $impact =
            $query->fetch();

        /**
         * Impact not found
         */
        if (!$impact) {

            Flash::set(

                'danger',

                'Impact not found.'
            );

            return $response->redirect(

                url('dashboard/impact')
            );
        }

        /**
         * Render page
         */
        $this->view(

            'admin.impact.edit',

            [

                'impact' =>
                    $impact
            ],

            'layouts.admin'
        );
    }

    /**
     * Update impact
     */
    public function update(
        $request,
        $response,
        $id
    )
    {
        /**
         * Check authorization
         */
        Authorization::authorize('impacts.edit');

        // Impact label
        $label =
            trim(
                $_POST['label']
                ??
                ''
            );

            // Impact value
            $value =
                trim(
                    $_POST['value']
                    ??
                    ''
                );

                // sort order
                $sortOrder =
                trim(
                    $_POST['sort_order']
                    ??
                    '0'
                );

        //validate request
        $validator = Validator::make(

            $_POST,

            [

                'label' => 'required|max:255',

                'value' => 'required|numeric',

                'status' => 'required|in:active,inactive'
            ]
        );
        if ($validator->fails()) {

            Flash::set(

                'danger',

                implode('<br>', $validator->all())
            );

            return $response->redirect(

                url('dashboard/impact/edit/' . $id)
            );
        }


        /**
         * Impact status
         */
        $status =
            $_POST['status']
            ??
            'active';


        /**
         * Database connection
         */
        $db =
            Connection::getInstance();


            // Fetch existing impact for audit logging
            $existingQuery = $db->prepare("

                SELECT *
                FROM impacts
                WHERE id = ?
                LIMIT 1

            ");

            $existingQuery->execute([$id]);

            $existingImpact = $existingQuery->fetch();

        /**
         * Ensure unique slug
         */
        // $slugCheck =
        //     $db->prepare("

        //         SELECT id
        //         FROM impacts
        //         WHERE slug = ?
        //         AND id != ?
        //         LIMIT 1

        //     ");

        // $slugCheck->execute([

        //     $slug,

        //     $id
        // ]);

        /**
         * Append timestamp if slug exists
         */
        // if ($slugCheck->fetch()) {

        //     $slug .= '-'
        //         .
        //         time();
        // }

        /**
         * Update impact
         */
        $query =
            $db->prepare("

                UPDATE impacts

                SET
                    label = ?,
                    value = ?,
                    sort_order = ?,
                    status = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        /**
         * Execute update
         */
        $query->execute([

            $label,

            $value,

            $_POST['sort_order'] ?? 0,

            $status,

            $id
        ]);

        /**
         * Audit log
         */
        AuditLog::log(

            'update',

            'impacts',

            $id,

            $existingImpact,

            [

                'label' =>
                    $label,

                'value' =>
                    $value,

                    'sort_order' =>
                        $_POST['sort_order'] ?? 0,

                'status' =>
                    $status

            ]

        );

        // Status change log
        if ($existingImpact['status'] !== $status) {

            AuditLog::log(

                $status === 'active' ? 'activated' : 'deactivated',

                'impacts',

                $id,

                null,

                [

                    'label' =>
                        $label
                ],

                'status_change'
            );
        }

    
        /**
         * Success message
         */
        Flash::set(

            'success',

            'Impact updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/impact')
        );
    }

    /**
     * Store impact via AJAX
     */
    public function storeAjax(
        $request,
        $response
    )
    {
            /**
            * Check if request is AJAX
            */
            if (!$request->isAjax()) {
    
                return $response->json([
    
                    'error' =>
                        'Invalid request.'
                ], 400);
            }

        /**
         * Check authorization
         */
        Authorization::authorize('impacts.create');

        /**
         * Impact label
         */
        $label =
            trim(
                $_POST['label']
                ??
                ''
            );

        /**
         * Impact value
         */
        $value =
            trim(
                $_POST['value']
                ??
                ''
            );


        /**
         * Database connection
         */
        $db =
            Connection::getInstance();


        /**
         * Ensure unique slug
         */
        // $slugCheck =
        //     $db->prepare("

        //         SELECT id
        //         FROM impacts
        //         WHERE slug = ?
        //         LIMIT 1

        //     ");

        // $slugCheck->execute([$slug]);

        /**
         * Append timestamp if slug exists
         */
        // if ($slugCheck->fetch()) {

        //     $slug .= '-'
        //         .
        //         time();
        // }

        /**
         * Insert impact
         */
        $query =
            $db->prepare("

                INSERT INTO impacts (

                    label,
                    value,
                    sort_order,
                    status,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, 'active', NOW(), NOW()

                )

            ");

        /**
         * Execute insert
         */
        $query->execute([

            $label,

            $value,

            $_POST['sort_order'] ?? 0
        ]);

        /**
         * Return JSON response
         */
        return $response->json([

            'id' =>
                $db->lastInsertId(),

            'label' =>
                $label
        ]);
    }
}