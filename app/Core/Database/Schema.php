<?php

namespace App\Core\Database;

class Schema
{
    /**
     * Create database table
     */
    public static function create($tableName, callable $callback)
    {
        // Get database connection
        $db = Connection::getInstance();

        /**
         * Create Blueprint instance
         */
        $blueprint = new Blueprint();

        /**
         * Run migration callback
         *
         * Example:
         * function ($table) {}
         */
        $callback($blueprint);

        /**
         * Get generated SQL definitions
         */
        $columns = $blueprint->getColumns();

        /**
         * Convert array into SQL string
         */
        $sqlColumns = implode(", ", $columns);

        /**
         * Final CREATE TABLE query
         */
        $sql = "
            CREATE TABLE {$tableName} (
                {$sqlColumns}
            )
        ";

        /**
         * Execute query
         */
        $db->exec($sql);

        echo "Table created: {$tableName}\n";
    }

    /**
     * Drop table if it exists
     */
    public static function dropIfExists($tableName)
    {
        // Get database connection
        $db = Connection::getInstance();

        /**
         * Execute DROP TABLE query
         */
        $db->exec("
            DROP TABLE IF EXISTS {$tableName}
        ");

        echo "Table dropped: {$tableName}\n";
    }

        /**
     * Modify existing table
     */
    public static function table($tableName, callable $callback)
    {
        /**
         * Create Blueprint instance
         */
        $blueprint = new Blueprint();

        /**
         * Run callback
         */
        $callback($blueprint);

        /**
         * Get generated ALTER queries
         */
        $queries = $blueprint->getAlterQueries();

        /**
         * Get database connection
         */
        $db = Connection::getInstance();

        /**
         * Execute each ALTER query
         */
        foreach ($queries as $query) {

            $sql = "
                ALTER TABLE {$tableName}
                {$query}
            ";

            $db->exec($sql);

            echo "Altered table: {$tableName}\n";
        }
    }
}