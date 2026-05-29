<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Slider;
use App\Models\Media;
use App\Core\Services\Auth;
use App\Core\Services\Flash;
use App\Core\Services\UploadService;
use App\Core\Database\Connection;
use App\Core\Validation\Validator;

class SliderController
extends BaseController
{
    /**
     * Sliders listing
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
         * Fetch sliders
         * with featured images
         */
        $query =
            $db->query("

                SELECT

                    sliders.*,

                    media.file_path AS featured_image

                FROM sliders

                LEFT JOIN media

                    ON media.mediable_id = sliders.id

                    AND media.mediable_type = 'slider'

                    AND media.is_featured = 1

                ORDER BY sliders.sort_order ASC,
                sliders.id DESC

            ");

        $sliders =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.sliders.index',

            [

                'sliders' =>
                    $sliders
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

            'admin.sliders.create',

            [],

            'layouts.admin'
        );
    }

    /**
     * Store slider
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
                'title' => 'required|max:255',
                'subtitle' => 'max:255',
                'button_text' => 'max:255',
                'sort_order' => 'integer|min:0',
                'status' => 'required|in:active,inactive'
            ]
        );
        if ($validator->fails()) {

            Flash::set(

                'danger',

                implode('<br>', $validator->all())
            );

            return $response->redirect(

                url('dashboard/sliders/create')
            );
        }


        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Insert slider
         */
        $query =
            $db->prepare("

                INSERT INTO sliders (

                    title,
                    subtitle,
                    button_text,
                    button_url,
                    sort_order,
                    featured,
                    status,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                )

            ");

        $query->execute([

            $_POST['title'],

            $_POST['subtitle']
                ??
                null,

            $_POST['button_text']
                ??
                null,

            $_POST['button_url']
                ??
                null,

            $_POST['sort_order']
                ??
                0,

            isset($_POST['featured'])
                ? 1
                : 0,

            $_POST['status']
        ]);

        /**
         * Slider ID
         */
        $sliderId =
            $db->lastInsertId();

        /**
         * Uploaded images
         */
        $images =
            $_FILES['images'];

        /**
         * Loop images
         */
        foreach (

            $images['name']
            as
            $index => $name

        ) {

            /**
             * Normalize file array
             */
            $file = [

                'name' =>
                    $images['name'][$index],

                'type' =>
                    $images['type'][$index],

                'tmp_name' =>
                    $images['tmp_name'][$index],

                'error' =>
                    $images['error'][$index],

                'size' =>
                    $images['size'][$index]
            ];

            /**
             * Upload image
             */
            $upload =
                UploadService::uploadImage(

                    $file,

                    'sliders'
                );

            /**
             * Featured image
             *
             * First image becomes featured
             */
            $isFeatured =
                $index === 0
                    ? 1
                    : 0;

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

                'slider',

                $sliderId,

                $upload['file_name'],

                $upload['file_path'],

                $upload['mime_type'],

                $upload['file_size'],

                $isFeatured,

                $index,

                'active'
            ]);
        }

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Slider created successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/sliders')
        );
    }

    /**
     * Edit slider form
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
         * Fetch slider
         */
        $slider =
            Slider::find($id);

        /**
         * Slider not found
         */
        if (!$slider) {

            return $response->notFound(
                'Slider not found.'
            );
        }

        /**
         * Fetch media gallery
         */
        $mediaQuery =
            $db->prepare("

                SELECT *
                FROM media
                WHERE mediable_type = ?
                AND mediable_id = ?
                ORDER BY sort_order ASC

            ");

        $mediaQuery->execute([

            'slider',

            $id
        ]);

        $media =
            $mediaQuery->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.sliders.edit',

            [

                'slider' =>
                    $slider,

                'media' =>
                    $media
            ],

            'layouts.admin'
        );
    }

    /**
     * Update slider
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
         * Fetch slider
         */
        $slider =
            Slider::find($id);

        /**
         * Slider not found
         */
        if (!$slider) {

            return $response->notFound(
                'Slider not found.'
            );
        }

        /**
         * Validate request
         */
        $validator = Validator::make(
            $_POST,
            [
                'title' => 'required|max:255',
                'subtitle' => 'max:255',
                'button_text' => 'max:255',
                'sort_order' => 'integer|min:0',
                'status' => 'required|in:active,inactive'
            ]
        );
        if ($validator->fails()) {

            Flash::set(

                'danger',

                implode('<br>', $validator->all())
            );

            return $response->redirect(

                url('dashboard/sliders/edit/' . $id)
            );
        }


        /**
         * Update slider
         */
        $query =
            $db->prepare("

                UPDATE sliders

                SET

                    title = ?,
                    subtitle = ?,
                    button_text = ?,
                    button_url = ?,
                    sort_order = ?,
                    featured = ?,
                    status = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        $query->execute([

            $_POST['title'],

            $_POST['subtitle']
                ??
                null,

            $_POST['button_text']
                ??
                null,

            $_POST['button_url']
                ??
                null,

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
         * Delete selected images
         */
        if (
            !empty($_POST['delete_images'])
        ) {

            foreach (

                $_POST['delete_images']
                as
                $mediaId

            ) {

                /**
                 * Fetch image
                 */
                $mediaQuery =
                    $db->prepare("

                        SELECT *
                        FROM media
                        WHERE id = ?
                        LIMIT 1

                    ");

                $mediaQuery->execute([

                    $mediaId
                ]);

                $media =
                    $mediaQuery->fetch();

                /**
                 * Delete physical file
                 */
                if (
                    $media
                    &&
                    file_exists(

                        __DIR__
                        .
                        '/../../../public/'
                        .
                        $media['file_path']
                    )
                ) {

                    unlink(

                        __DIR__
                        .
                        '/../../../public/'
                        .
                        $media['file_path']
                    );
                }

                /**
                 * Prevent deleting featured image
                 * without replacement
                 */
                if (
                    $media['is_featured']
                    &&
                    empty($_POST['featured_image'])
                ) {

                    continue;
                }

                /**
                 * Delete database row
                 */
                $deleteMedia =
                    $db->prepare("

                        DELETE FROM media
                        WHERE id = ?

                    ");

                $deleteMedia->execute([

                    $mediaId
                ]);
            }
        }

        /**
         * Update featured image
         */
        if (
            !empty($_POST['featured_image'])
        ) {

            /**
             * Reset all featured flags
             */
            $resetFeatured =
                $db->prepare("

                    UPDATE media

                    SET is_featured = 0

                    WHERE mediable_type = ?
                    AND mediable_id = ?

                ");

            $resetFeatured->execute([

                'slider',

                $id
            ]);

            /**
             * Set selected image
             */
            $setFeatured =
                $db->prepare("

                    UPDATE media

                    SET is_featured = 1

                    WHERE id = ?

                ");

            $setFeatured->execute([

                $_POST['featured_image']
            ]);
        }

        /**
         * Upload new images
         */
        if (
            !empty($_FILES['images']['name'][0])
        ) {

            $images =
                $_FILES['images'];

            /**
             * Existing media count
             */
            $countQuery =
                $db->prepare("

                    SELECT COUNT(*) as total
                    FROM media
                    WHERE mediable_type = ?
                    AND mediable_id = ?

                ");

            $countQuery->execute([

                'slider',

                $id
            ]);

            $count =
                $countQuery->fetch();

            $sortOrder =
                $count['total'];

            /**
             * Loop images
             */
            foreach (

                $images['name']
                as
                $index => $name

            ) {

                /**
                 * Normalize file
                 */
                $file = [

                    'name' =>
                        $images['name'][$index],

                    'type' =>
                        $images['type'][$index],

                    'tmp_name' =>
                        $images['tmp_name'][$index],

                    'error' =>
                        $images['error'][$index],

                    'size' =>
                        $images['size'][$index]
                ];

                /**
                 * Upload image
                 */
                $upload =
                    UploadService::uploadImage(

                        $file,

                        'sliders'
                    );

                /**
                 * Store media
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

                /**
                 * Featured logic
                 */
                $isFeatured =
                    0;

                /**
                 * Check existing featured image
                 */
                $featuredCheck =
                    $db->prepare("

                        SELECT id
                        FROM media
                        WHERE mediable_type = ?
                        AND mediable_id = ?
                        AND is_featured = 1
                        LIMIT 1

                    ");

                $featuredCheck->execute([

                    'slider',

                    $id
                ]);

                /**
                 * If none exists
                 */
                if (
                    !$featuredCheck->fetch()
                ) {

                    $isFeatured = 1;
                }

                $mediaInsert->execute([

                    'slider',

                    $id,

                    $upload['file_name'],

                    $upload['file_path'],

                    $upload['mime_type'],

                    $upload['file_size'],

                    $isFeatured,

                    $sortOrder,

                    'active'
                ]);

                $sortOrder++;
            }
        }

        /**
         * Ensure at least one image remains
         */
        $imageCheck =
            $db->prepare("

                SELECT COUNT(*) as total
                FROM media
                WHERE mediable_type = ?
                AND mediable_id = ?

            ");

        $imageCheck->execute([

            'slider',

            $id
        ]);

        $remaining =
            $imageCheck->fetch();

        if ($remaining['total'] < 1) {

            return $response->send(
                'A slider must have at least one image.'
            );
        }

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Slider updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/sliders')
        );
    }
}