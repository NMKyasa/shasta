<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TeamMember;
use App\Core\Services\Auth;
use App\Core\Services\UploadService;
use App\Core\Database\Connection;
use App\Core\Services\Flash;
use App\Core\Validation\Validator;

class TeamController
extends BaseController
{
    /**
     * Team members listing
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
         * Fetch team members
         * with profile image
         */
        $query =
            $db->query("

                SELECT

                    team_members.*,

                    media.file_path
                    AS featured_image

                FROM team_members

                LEFT JOIN media

                    ON media.mediable_id = team_members.id

                    AND media.mediable_type = 'team'

                    AND media.is_featured = 1

                WHERE team_members.deleted_at IS NULL

                ORDER BY
                    team_members.sort_order ASC,
                    team_members.id DESC

            ");

        /**
         * Team members results
         */
        $teamMembers =
            $query->fetchAll();

        /**
         * Render page
         */
        $this->view(

            'admin.team.index',

            [

                'teamMembers' =>
                    $teamMembers
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

            'admin.team.create',

            [],

            'layouts.admin'
        );
    }

    /**
     * Store team member
     */
    public function store(
        $request,
        $response
    )
    {
        // validate request
        $validator = Validator::make($_POST, [

            'name' => 'required|max:255',

            'email' => 'nullable|email|max:255',

            'status' => 'required|in:active,inactive'
        ]);
        if ($validator->fails()) {

            Flash::set(

                'danger',

                'Please correct the errors in the form.'
            );

            return $response->redirect(

                url('dashboard/team/create')
            );
        }

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Insert team member
         */
        $query =
            $db->prepare("

                INSERT INTO team_members (

                    name,
                    position,
                    bio,
                    email,
                    phone,
                    facebook_url,
                    twitter_url,
                    linkedin_url,
                    instagram_url,
                    sort_order,
                    featured,
                    status,
                    created_at,
                    updated_at

                )

                VALUES (

                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()

                )

            ");

        $query->execute([

            $_POST['name'],

            $_POST['position']
                ??
                null,

            $_POST['bio']
                ??
                null,

            $_POST['email']
                ??
                null,

            $_POST['phone']
                ??
                null,

            $_POST['facebook_url']
                ??
                null,

            $_POST['twitter_url']
                ??
                null,

            $_POST['linkedin_url']
                ??
                null,

            $_POST['instagram_url']
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
         * Team member ID
         */
        $teamMemberId =
            $db->lastInsertId();

        /**
         * Upload profile image
         */
        $upload =
            UploadService::uploadImage(

                $_FILES['image'],

                'team'
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

            'team',

            $teamMemberId,

            $upload['file_name'],

            $upload['file_path'],

            $upload['mime_type'],

            $upload['file_size'],

            1,

            0,

            'active'
        ]);

        /**
         * Success message
         */
        Flash::set(

            'success',

            'Team member created successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/team')
        );
    }

    /**
     * Edit team member
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
         * Fetch team member
         */
        $teamMember =
            TeamMember::find($id);

        /**
         * Team member not found
         */
        if (!$teamMember) {

            return $response->notFound(

                'Team member not found.'
            );
        }

        /**
         * Fetch profile image
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

            'team',

            $id
        ]);

        $media =
            $mediaQuery->fetch();

        /**
         * Render page
         */
        $this->view(

            'admin.team.edit',

            [

                'teamMember' =>
                    $teamMember,

                'media' =>
                    $media
            ],

            'layouts.admin'
        );
    }

    /**
     * Update team member
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
         * Fetch team member
         */
        $teamMember =
            TeamMember::find($id);

        /**
         * Team member not found
         */
        if (!$teamMember) {

            return $response->notFound(

                'Team member not found.'
            );
        }

        // validate request
        $validator = Validator::make($_POST, [

            'name' => 'required|max:255',

            'email' => 'nullable|email|max:255',

            'status' => 'required|in:active,inactive'
        ]);
        if ($validator->fails()) {

            Flash::set(

                'danger',

                'Please correct the errors in the form.'
            );

            return $response->redirect(

                url('dashboard/team/edit/' . $id)
            );
        }

        /**
         * Update team member
         */
        $query =
            $db->prepare("

                UPDATE team_members

                SET

                    name = ?,
                    position = ?,
                    bio = ?,
                    email = ?,
                    phone = ?,
                    facebook_url = ?,
                    twitter_url = ?,
                    linkedin_url = ?,
                    instagram_url = ?,
                    sort_order = ?,
                    featured = ?,
                    status = ?,
                    updated_at = NOW()

                WHERE id = ?

            ");

        $query->execute([

            $_POST['name'],

            $_POST['position']
                ??
                null,

            $_POST['bio']
                ??
                null,

            $_POST['email']
                ??
                null,

            $_POST['phone']
                ??
                null,

            $_POST['facebook_url']
                ??
                null,

            $_POST['twitter_url']
                ??
                null,

            $_POST['linkedin_url']
                ??
                null,

            $_POST['instagram_url']
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
         * Replace profile image
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

                'team',

                $id
            ]);

            $oldMedia =
                $oldMediaQuery->fetch();

            /**
             * Delete old physical file
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

                    'team'
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

                'team',

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

            'Team member updated successfully.'
        );

        /**
         * Redirect
         */
        return $response->redirect(

            url('dashboard/team')
        );
    }
}