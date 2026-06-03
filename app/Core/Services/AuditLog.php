<?php

namespace App\Core\Services;

use App\Core\Database\Connection;

class AuditLog
{
    /**
     * Write audit log
     */
    public static function log(
        string $action,
        string $module,
        ?int $targetId = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        string $logType = 'activity'
    ): void
    {
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Insert log
         */
        $query =
            $db->prepare(
                "
                INSERT INTO audit_logs
                (
                    user_id,
                    action,
                    module,
                    target_id,
                    old_values,
                    new_values,
                    ip_address,
                    user_agent,
                    log_type,
                    created_at,
                    updated_at
                )
                VALUES
                (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()
                )
                "
            );

        $query->execute([

            Auth::id(),

            $action,

            $module,

            $targetId,

            $oldValues
                ? json_encode($oldValues)
                : null,

            $newValues
                ? json_encode($newValues)
                : null,

            $_SERVER['REMOTE_ADDR']
                ?? null,

            $_SERVER['HTTP_USER_AGENT']
                ?? null,

            $logType
        ]);
    }
}