<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Setting;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Services\UploadService;

class SettingController
extends BaseController
{
    /**
     * Settings page
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
         * Fetch all settings
         */
        $query =
            $db->query("

                SELECT *
                FROM settings

            ");

        /**
         * Raw settings
         */
        $results =
            $query->fetchAll();

        /**
         * Formatted settings array
         */
        $settings = [];

        /**
         * Transform settings
         */
        foreach (
            $results
            as
            $setting
        ) {

            $settings[
                $setting['setting_key']
            ] =
                $setting['setting_value'];
        }

        /**
         * Render page
         */
        $this->view(

            'admin.settings.index',

            [

                'settings' =>
                    $settings
            ],

            'layouts.admin'
        );
    }

    /**
     * Update settings
     */
    public function update(
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
         * Remove submit button
         */
        unset($_POST['_token']);

        /**
         * SETTINGS GROUPS
         */
        $groups = [

            /**
             * General settings
             */
            'site_name'           => 'general',
            'site_tagline'        => 'general',
            'company_email'       => 'general',
            'phone_number'        => 'general',
            'footer_text'         => 'general',

            /**
             * Social media
             */
            'facebook_url'        => 'social',
            'twitter_url'         => 'social',
            'instagram_url'       => 'social',
            'linkedin_url'        => 'social',
            'youtube_url'         => 'social',

            /**
             * SEO
             */
            'meta_title'          => 'seo',
            'meta_description'    => 'seo',
            'meta_keywords'       => 'seo',
            'google_analytics'    => 'seo',

            /**
             * Contact
             */
            'office_address'      => 'contact',
            'working_hours'       => 'contact',
            'google_maps_embed'   => 'contact',

            /**
             * Branding
             */
            'logo'                => 'branding',
            'dark_logo'           => 'branding',
            'favicon'             => 'branding'
        ];

        /**
         * Handle normal settings
         */
        foreach (
            $_POST
            as
            $key => $value
        ) {

            /**
             * Skip unknown settings
             */
            if (
                !isset($groups[$key])
            ) {

                continue;
            }

            /**
             * Check existing setting
             */
            $existing =
                $db->prepare("

                    SELECT id
                    FROM settings
                    WHERE setting_key = ?
                    LIMIT 1

                ");

            $existing->execute([$key]);

            $setting =
                $existing->fetch();

            /**
             * Update existing
             */
            if ($setting) {

                $update =
                    $db->prepare("

                        UPDATE settings

                        SET

                            setting_value = ?,
                            updated_at = NOW()

                        WHERE setting_key = ?

                    ");

                $update->execute([

                    $value,

                    $key
                ]);

            } else {

                /**
                 * Insert new setting
                 */
                $insert =
                    $db->prepare("

                        INSERT INTO settings (

                            setting_key,
                            setting_value,
                            setting_group,
                            autoload,
                            created_at,
                            updated_at

                        )

                        VALUES (

                            ?, ?, ?, 1, NOW(), NOW()

                        )

                    ");

                $insert->execute([

                    $key,

                    $value,

                    $groups[$key]
                ]);
            }
        }

        /**
         * HANDLE LOGO UPLOADS
         */
        $imageFields = [

            'logo',

            'dark_logo',

            'favicon'
        ];

        /**
         * Process uploads
         */
        foreach (
            $imageFields
            as
            $field
        ) {

            /**
             * Skip empty uploads
             */
            if (

                empty(
                    $_FILES[$field]['name']
                )
            ) {

                continue;
            }

            /**
             * Upload image
             */
            $upload =
                UploadService::uploadImage(

                    $_FILES[$field],

                    'settings'
                );

            /**
             * Existing image
             */
            $existing =
                $db->prepare("

                    SELECT *
                    FROM settings
                    WHERE setting_key = ?
                    LIMIT 1

                ");

            $existing->execute([$field]);

            $existingSetting =
                $existing->fetch();

            /**
             * Delete old image
             */
            if (

                $existingSetting

                &&

                !empty(
                    $existingSetting['setting_value']
                )
            ) {

                $oldPath =
                    __DIR__
                    .
                    '/../../../public/'
                    .
                    $existingSetting['setting_value'];

                if (
                    file_exists($oldPath)
                ) {

                    unlink($oldPath);
                }
            }

            /**
             * Update existing setting
             */
            if ($existingSetting) {

                $update =
                    $db->prepare("

                        UPDATE settings

                        SET

                            setting_value = ?,
                            updated_at = NOW()

                        WHERE setting_key = ?

                    ");

                $update->execute([

                    $upload['file_path'],

                    $field
                ]);

            } else {

                /**
                 * Insert setting
                 */
                $insert =
                    $db->prepare("

                        INSERT INTO settings (

                            setting_key,
                            setting_value,
                            setting_group,
                            autoload,
                            created_at,
                            updated_at

                        )

                        VALUES (

                            ?, ?, 'branding', 1, NOW(), NOW()

                        )

                    ");

                $insert->execute([

                    $field,

                    $upload['file_path']
                ]);
            }
        }

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Settings updated successfully.'
        );

        /**
         * Redirect back
         */
        return $response->redirect(

            url('dashboard/settings')
        );
    }

    /**
     * About settings page
     */
    public function about(
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
         * Fetch about settings
         */
        $query =
            $db->prepare("

                SELECT *

                FROM settings

                WHERE setting_group = ?

            ");

        $query->execute([

            'about'
        ]);

        /**
         * Settings
         */
        $settings = [];

        foreach (

            $query->fetchAll()
            as
            $setting

        ) {

            $settings[
                $setting['setting_key']
            ] =
                $setting['setting_value'];
        }

        /**
         * Fetch about image
         */
        $imageQuery =
            $db->prepare("

                SELECT *

                FROM media

                WHERE mediable_type = 'setting'
                AND mediable_id = 0
                AND is_featured = 1

                LIMIT 1

            ");

        $imageQuery->execute();

        /**
         * About image
         */
        $settings['about_image'] =
            $imageQuery->fetch();

        /**
         * Render page
         */
        $this->view(

            'admin.settings.about',

            [

                'settings' =>
                    $settings
            ],

            'layouts.admin'
        );
    }

    /**
     * Update about settings
     */
    public function updateAbout(
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
         * Allowed fields
         */
        $fields = [

            'about_title',

            'about_subtitle',

            'about_content',

            'about_mission',

            'about_vision',

            'about_impact',

            'about_experience_years',

            'about_button_text',

            'about_button_url',

            'about_video_url'
        ];

        /**
         * Save settings
         */
        foreach (

            $fields
            as
            $field

        ) {

            /**
             * Value
             */
            $value =
                $_POST[$field]
                ??
                '';

            /**
             * Check existing
             */
            $checkQuery =
                $db->prepare("

                    SELECT id

                    FROM settings

                    WHERE setting_key = ?

                    LIMIT 1

                ");

            $checkQuery->execute([

                $field
            ]);

            /**
             * Existing setting
             */
            $existing =
                $checkQuery->fetch();

            /**
             * Update existing
             */
            if ($existing) {

                $updateQuery =
                    $db->prepare("

                        UPDATE settings

                        SET

                            setting_value = ?,
                            updated_at = NOW()

                        WHERE setting_key = ?

                    ");

                $updateQuery->execute([

                    $value,

                    $field
                ]);

            } else {

                /**
                 * Insert new
                 */
                $insertQuery =
                    $db->prepare("

                        INSERT INTO settings (

                            setting_key,
                            setting_value,
                            setting_group,
                            autoload,
                            created_at,
                            updated_at

                        )

                        VALUES (

                            ?, ?, ?, 1, NOW(), NOW()

                        )

                    ");

                $insertQuery->execute([

                    $field,

                    $value,

                    'about'
                ]);
            }
        }

        /**
         * Upload about image
         */
        if (

            !empty(
                $_FILES['about_image']['name']
            )

        ) {

            /**
             * Existing image
             */
            $existingImageQuery =
                $db->prepare("

                    SELECT *

                    FROM media

                    WHERE mediable_type = 'setting'
                    AND mediable_id = 0
                    AND is_featured = 1

                    LIMIT 1

                ");

            $existingImageQuery->execute();

            $existingImage =
                $existingImageQuery->fetch();

            /**
             * Delete old image
             */
            if (

                $existingImage

                &&

                file_exists(

                    __DIR__
                    .
                    '/../../../public/'
                    .
                    $existingImage['file_path']
                )
            ) {

                unlink(

                    __DIR__
                    .
                    '/../../../public/'
                    .
                    $existingImage['file_path']
                );
            }

            /**
             * Delete old media record
             */
            $deleteQuery =
                $db->prepare("

                    DELETE FROM media

                    WHERE mediable_type = 'setting'
                    AND mediable_id = 0
                    AND is_featured = 1

                ");

            $deleteQuery->execute();

            /**
             * Upload new image
             */
            $upload =
                UploadService::uploadImage(

                    $_FILES['about_image'],

                    'settings'
                );

            /**
             * Save media
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

                'setting',

                0,

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

            'About settings updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/settings/about')
        );
    }
}  