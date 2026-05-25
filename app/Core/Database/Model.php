<?php

namespace App\Core\Database;

use PDO;

abstract class Model
{
    /**
     * Table name
     */
    protected static $table;

    /**
     * Primary key
     */
    protected static $primaryKey = 'id';

    /**
     * Database connection
     */
    protected static function db()
    {
        return Connection::getInstance();
    }

    /**
     * Get all records
     */
    public static function all()
    {
        $table = static::$table;

        $query =
            self::db()->query(
                "SELECT * FROM {$table}"
            );

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find single record
     */
    public static function find($id)
    {
        $table = static::$table;

        $primaryKey =
            static::$primaryKey;

        $query =
            self::db()->prepare(
                "
                SELECT *
                FROM {$table}
                WHERE {$primaryKey} = ?
                LIMIT 1
                "
            );

        $query->execute([$id]);

        return $query->fetch(
            PDO::FETCH_ASSOC
        );
    }

    /**
     * Create new record
     */
    public static function create(
        array $data
    )
    {
        $table = static::$table;

        /**
         * Column names
         */
        $columns =
            implode(
                ', ',
                array_keys($data)
            );

        /**
         * Placeholders
         */
        $placeholders =
            implode(
                ', ',
                array_fill(
                    0,
                    count($data),
                    '?'
                )
            );

        /**
         * Prepare query
         */
        $query =
            self::db()->prepare(
                "
                INSERT INTO {$table}
                ({$columns})
                VALUES
                ({$placeholders})
                "
            );

        /**
         * Execute insert
         */
        return $query->execute(
            array_values($data)
        );
    }

    /**
     * Update record
     */
    public static function update(
        $id,
        array $data
    )
    {
        $table = static::$table;

        $primaryKey =
            static::$primaryKey;

        /**
         * Build SET clauses
         */
        $fields = [];

        foreach ($data as $key => $value) {

            $fields[] = "{$key} = ?";
        }

        $setClause =
            implode(', ', $fields);

        /**
         * Prepare query
         */
        $query =
            self::db()->prepare(
                "
                UPDATE {$table}
                SET {$setClause}
                WHERE {$primaryKey} = ?
                "
            );

        /**
         * Values
         */
        $values = array_values($data);

        $values[] = $id;

        /**
         * Execute update
         */
        return $query->execute(
            $values
        );
    }

    /**
     * Delete record
     */
    public static function delete($id)
    {
        $table = static::$table;

        $primaryKey =
            static::$primaryKey;

        $query =
            self::db()->prepare(
                "
                DELETE FROM {$table}
                WHERE {$primaryKey} = ?
                "
            );

        return $query->execute([$id]);
    }

    /**
     * Basic WHERE query
     */
    public static function where(
        $column,
        $value
    )
    {
        $table = static::$table;

        $query =
            self::db()->prepare(
                "
                SELECT *
                FROM {$table}
                WHERE {$column} = ?
                "
            );

        $query->execute([$value]);

        return $query->fetchAll(
            PDO::FETCH_ASSOC
        );
    }

     /**
     * Get first matching record
     */
    public static function firstWhere(
        $column,
        $value
    )
    {
        $table = static::$table;

        $query =
            self::db()->prepare(
                "
                SELECT *
                FROM {$table}
                WHERE {$column} = ?
                LIMIT 1
                "
            );

        $query->execute([$value]);

        return $query->fetch(
            \PDO::FETCH_ASSOC
        );
    }
}