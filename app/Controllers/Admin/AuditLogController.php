<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Auth\Authorization;
use App\Core\Database\Connection;
use App\Core\Services\Flash;

class AuditLogController
extends BaseController
{
    /**
     * Audit logs listing
     */
    public function index(
        $request,
        $response
    )
    {
        /**
         * Authorization
         */
        Authorization::authorize(
            'audit_logs.view'
        );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Filters
         */
        $search =
            trim(
                $_GET['search']
                ??
                ''
            );

        $module =
            trim(
                $_GET['module']
                ??
                ''
            );

        $logType =
            trim(
                $_GET['log_type']
                ??
                ''
            );

        $userId =
            trim(
                $_GET['user_id']
                ??
                ''
            );

        /**
         * Query
         */
        $sql = "

            SELECT

                al.*,

                CONCAT(
                    u.first_name,
                    ' ',
                    u.last_name
                )
                AS user_name

            FROM audit_logs al

            LEFT JOIN users u

                ON u.id = al.user_id

            WHERE 1 = 1

        ";

        $params = [];

        /**
         * Search
         */
        if (
            !empty($search)
        ) {

            $sql .= "

                AND (

                    al.action LIKE ?

                    OR

                    al.module LIKE ?

                )

            ";

            $params[] =
                '%'
                .
                $search
                .
                '%';

            $params[] =
                '%'
                .
                $search
                .
                '%';
        }

        /**
         * Module filter
         */
        if (
            !empty($module)
        ) {

            $sql .= "
                AND al.module = ?
            ";

            $params[] =
                $module;
        }

        /**
         * Log type filter
         */
        if (
            !empty($logType)
        ) {

            $sql .= "
                AND al.log_type = ?
            ";

            $params[] =
                $logType;
        }

        /**
         * User filter
         */
        if (
            !empty($userId)
        ) {

            $sql .= "
                AND al.user_id = ?
            ";

            $params[] =
                $userId;
        }

        /**
         * Order
         */
        $sql .= "

            ORDER BY
                al.id DESC

        ";

        /**
         * Execute query
         */
        $query =
            $db->prepare(
                $sql
            );

        $query->execute(
            $params
        );

        $auditLogs =
            $query->fetchAll();

        /**
         * Modules
         */
        $query =
            $db->query(
                "

                SELECT DISTINCT
                    module

                FROM audit_logs

                ORDER BY module ASC

                "
            );

        $modules =
            $query->fetchAll();

        /**
         * Users
         */
        $query =
            $db->query(
                "

                SELECT

                    id,

                    first_name,

                    last_name

                FROM users

                ORDER BY
                    first_name ASC,
                    last_name ASC

                "
            );

        $users =
            $query->fetchAll();

        /**
         * Render view
         */
        return $this->view(

            'admin.audit_logs.index',

            [

                'auditLogs' =>
                    $auditLogs,

                'modules' =>
                    $modules,

                'users' =>
                    $users,

                'filters' => [

                    'search' =>
                        $search,

                    'module' =>
                        $module,

                    'log_type' =>
                        $logType,

                    'user_id' =>
                        $userId
                ]
            ],

            'layouts.admin'
        );
    }

    /**
     * View audit log
     */
    public function show(
        $request,
        $response,
        $id
    )
    {
        /**
         * Authorization
         */
        Authorization::authorize(
            'audit_logs.view'
        );

        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Fetch audit log
         */
        $query =
            $db->prepare(
                "

                SELECT

                    al.*,

                    CONCAT(
                        u.first_name,
                        ' ',
                        u.last_name
                    )
                    AS user_name

                FROM audit_logs al

                LEFT JOIN users u

                    ON u.id = al.user_id

                WHERE al.id = ?

                LIMIT 1

                "
            );

        $query->execute([
            $id
        ]);

        $auditLog =
            $query->fetch();

        /**
         * Not found
         */
        if (
            !$auditLog
        ) {

            Flash::set(

                'danger',

                'Audit log not found.'
            );

            return $response->redirect(

                url(
                    'dashboard/audit_logs'
                )
            );
        }

        /**
         * Decode JSON
         */
        $auditLog['old_values'] =

            !empty(
                $auditLog['old_values']
            )

            ?

            json_decode(
                $auditLog['old_values'],
                true
            )

            :

            [];

        $auditLog['new_values'] =

            !empty(
                $auditLog['new_values']
            )

            ?

            json_decode(
                $auditLog['new_values'],
                true
            )

            :

            [];

        /**
         * Render page
         */
        return $this->view(

            'admin.audit_logs.show',

            [

                'auditLog' =>
                    $auditLog

            ],

            'layouts.admin'
        );
    }
}
