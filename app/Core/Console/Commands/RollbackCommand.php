<?php

namespace App\Core\Console\Commands;

// Import database connection class
use App\Core\Database\Connection;

class RollbackCommand
{
    /**
     * Run rollback process
     */
    public function handle()
    {
        // Get PDO database connection
        $db = Connection::getInstance();

        /**
         * Get the latest migration batch number
         *
         * Example:
         * batch = 1778143012
         */
        $latestBatch = $db->query("
            SELECT MAX(batch) as batch
            FROM migrations
        ")->fetch();

        /**
         * If no batch exists,
         * there is nothing to rollback
         */
        if (!$latestBatch['batch']) {

            exit("No migrations to rollback.\n");
        }

        // Store latest batch number
        $batch = $latestBatch['batch'];

        /**
         * Get all migrations
         * belonging to latest batch
         *
         * ORDER BY id DESC ensures:
         * newest migrations rollback first
         */
        $migrations = $db->query("
            SELECT migration
            FROM migrations
            WHERE batch = {$batch}
            ORDER BY id DESC
        ")->fetchAll();

        /**
         * Loop through each migration
         */
        foreach ($migrations as $migrationRow) {

            // Get migration filename
            $migration = $migrationRow['migration'];

            /**
             * Build full migration file path
             */
            $file = __DIR__ .
                "/../../../../database/migrations/{$migration}";

            /**
             * Ensure migration file exists
             */
            if (!file_exists($file)) {

                echo "Migration file missing: {$migration}\n";

                continue;
            }

            /**
             * Load migration file
             */
            require_once $file;

            /**
             * Extract class name
             *
             * Example:
             * 2026_05_07_103416_create_users_table.php
             *
             * becomes:
             * CreateUsersTable
             */
            $className = pathinfo(
                $migration,
                PATHINFO_FILENAME
            );

            // Split filename into parts
            $parts = explode('_', $className);

            /**
             * Remove timestamp parts
             * then convert remaining
             * words into PascalCase
             */
            $className = implode(
                '',
                array_map(
                    'ucfirst',
                    array_slice($parts, 4)
                )
            );

            /**
             * Ensure migration class exists
             */
            if (!class_exists($className)) {

                echo "Class {$className} not found.\n";

                continue;
            }

            /**
             * Create migration instance
             */
            $instance = new $className();

            /**
             * Execute down() method
             *
             * This reverses migration
             */
            $instance->down();

            /**
             * Remove migration record
             * from migrations table
             */
            $stmt = $db->prepare("
                DELETE FROM migrations
                WHERE migration = ?
            ");

            $stmt->execute([$migration]);

            /**
             * Success message
             */
            echo "Rolled back: {$migration}\n";
        }
    }
}