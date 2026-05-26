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
}