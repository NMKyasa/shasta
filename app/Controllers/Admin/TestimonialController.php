<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Testimonial;
use App\Core\Services\UploadService;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Validation\Validator;

class TestimonialController
extends BaseController
{
    /**
     * Testimonials listing
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
         * Fetch testimonials
         */
        $query =
            $db->query("

                SELECT

                    testimonials.*,

                    media.file_path
                    AS featured_image

                FROM testimonials

                LEFT JOIN media

                    ON media.mediable_id = testimonials.id

                    AND media.mediable_type = 'testimonials'

                    AND media.is_featured = 1

                WHERE testimonials.deleted_at IS NULL

                ORDER BY
                    testimonials.sort_order ASC,
                    testimonials.id DESC

            ");

        /**
         * Testimonials results
         */
        $testimonials =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.testimonials.index',

            [

                'testimonials' =>
                    $testimonials
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
         * Render page
         */
        $this->view(

            'admin.testimonials.create',

            [],

            'layouts.admin'
        );
    }

    /**
     * Store testimonial
     */
    public function store(
        $request,
        $response
    )
    {
        /**
         * Validate request
         */
        $validator = Validator::make(

            $_POST,

            [

                'name' => 'required',

                'message' => 'required',

                'rating' => 'required|integer|min:1|max:5',

                'status' => 'required|in:active,inactive'

            ]

        );
        if ($validator->fails()) {

            Flash::set(

                'danger',

                'Please correct the errors in the form.'
            );

            return $response->redirect(

                url('dashboard/testimonials/create')
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Insert testimonial
         */
        $query =
            $db->prepare("

                INSERT INTO testimonials (

                    name,
                    company,
                    position,
                    message,
                    rating,
                    sort_order,
                    featured,
                    status,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                )

            ");

        $query->execute([

            $_POST['name'],

            $_POST['company']
                ??
                null,

            $_POST['position']
                ??
                null,

            $_POST['message'],

            $_POST['rating'],

            $_POST['sort_order']
                ??
                0,

            isset($_POST['featured'])
                ? 1
                : 0,

            $_POST['status']
        ]);

        /**
         * Testimonial ID
         */
        $testimonialId =
            $db->lastInsertId();

        /**
         * Upload image
         */
        if (
            !empty($_FILES['image']['name'])
        ) {

            $upload =
                UploadService::uploadImage(

                    $_FILES['image'],

                    'testimonials'
                );

            /**
             * Store media
             */
            $mediaQuery =
                $db->prepare("

                    INSERT INTO media (

                        mediable_type,
                        mediable_id,
                        file_name,
                        file_path,
                        mime_type,
                        file_size,
                        is_featured,
                        sort_order,
                        status,
                        created_at,
                        updated_at

                    )

                    VALUES (

                        ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                    )

                ");

            $mediaQuery->execute([

                'testimonials',

                $testimonialId,

                $upload['file_name'],

                $upload['file_path'],

                $upload['mime_type'],

                $upload['file_size'],

                1,

                0,

                'active'
            ]);
        }

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Testimonial created successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/testimonials')
        );
    }

    /**
     * Edit testimonial
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
         * Fetch testimonial
         */
        $testimonial =
            Testimonial::find($id);

        /**
         * Testimonial not found
         */
        if (!$testimonial) {

            return $response->notFound(

                'Testimonial not found.'
            );
        }

        /**
         * Fetch image
         */
        $mediaQuery =
            $db->prepare("

                SELECT *
                FROM media
                WHERE mediable_type = ?
                AND mediable_id = ?
                AND is_featured = 1
                LIMIT 1

            ");

        $mediaQuery->execute([

            'testimonials',

            $id
        ]);

        $media =
            $mediaQuery->fetch();

        /**
         * Render page
         */
        $this->view(

            'admin.testimonials.edit',

            [

                'testimonial' =>
                    $testimonial,

                'media' =>
                    $media
            ],

            'layouts.admin'
        );
    }

    /**
     * Update testimonial
     */
    public function update(
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
         * Fetch testimonial
         */
        $testimonial =
            Testimonial::find($id);

        /**
         * Testimonial not found
         */
        if (!$testimonial) {

            return $response->notFound(

                'Testimonial not found.'
            );
        }

        /**
         * Validate request
         */
        $validator = Validator::make(

            $_POST,

            [

                'name' => 'required',

                'message' => 'required',

                'rating' => 'required|integer|min:1|max:5',

                'status' => 'required|in:active,inactive'

            ]
        );

        if ($validator->fails()) {

            Flash::set(

                'danger',

                'Please correct the errors in the form.'
            );

            return $response->redirect(

                url('dashboard/testimonials/edit/' . $id)
            );
        }

        /**
         * Update testimonial
         */
        $query =
            $db->prepare("

                UPDATE testimonials

                SET

                    name = ?,
                    company = ?,
                    position = ?,
                    message = ?,
                    rating = ?,
                    sort_order = ?,
                    featured = ?,
                    status = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        $query->execute([

            $_POST['name'],

            $_POST['company']
                ??
                null,

            $_POST['position']
                ??
                null,

            $_POST['message'],

            $_POST['rating'],

            $_POST['sort_order']
                ??
                0,

            isset($_POST['featured'])
                ? 1
                : 0,

            $_POST['status'],

            $id
        ]);

        /**
         * Replace image
         */
        if (
            !empty($_FILES['image']['name'])
        ) {

            /**
             * Fetch old image
             */
            $oldMediaQuery =
                $db->prepare("

                    SELECT *
                    FROM media
                    WHERE mediable_type = ?
                    AND mediable_id = ?
                    AND is_featured = 1
                    LIMIT 1

                ");

            $oldMediaQuery->execute([

                'testimonials',

                $id
            ]);

            $oldMedia =
                $oldMediaQuery->fetch();

            /**
             * Delete old file
             */
            if (

                $oldMedia

                &&

                file_exists(

                    __DIR__
                    .
                    '/../../../public/'
                    .
                    $oldMedia['file_path']
                )
            ) {

                unlink(

                    __DIR__
                    .
                    '/../../../public/'
                    .
                    $oldMedia['file_path']
                );
            }

            /**
             * Delete old media row
             */
            if ($oldMedia) {

                $deleteMedia =
                    $db->prepare("

                        DELETE FROM media
                        WHERE id = ?

                    ");

                $deleteMedia->execute([

                    $oldMedia['id']
                ]);
            }

            /**
             * Upload new image
             */
            $upload =
                UploadService::uploadImage(

                    $_FILES['image'],

                    'testimonials'
                );

            /**
             * Insert new media
             */
            $mediaInsert =
                $db->prepare("

                    INSERT INTO media (

                        mediable_type,
                        mediable_id,
                        file_name,
                        file_path,
                        mime_type,
                        file_size,
                        is_featured,
                        sort_order,
                        status,
                        created_at,
                        updated_at

                    )

                    VALUES (

                        ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                    )

                ");

            $mediaInsert->execute([

                'testimonials',

                $id,

                $upload['file_name'],

                $upload['file_path'],

                $upload['mime_type'],

                $upload['file_size'],

                1,

                0,

                'active'
            ]);
        }

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Testimonial updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url(
                'dashboard/testimonials'
            )
        );
    }
}