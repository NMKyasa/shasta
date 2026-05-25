<?php

use App\Core\Database\Migration;
use App\Core\Database\Connection;

class AlterServicesTableAddMissingFields extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        /**
         * Database connection
         */
        $db = Connection::getInstance();

        /**
         * Alter services table
         */
        $db->exec("

            ALTER TABLE services

            ADD COLUMN featured_image
            VARCHAR(255)
            NULL
            AFTER body,

            ADD COLUMN created_by
            BIGINT NULL
            AFTER status,

            ADD COLUMN updated_by
            BIGINT NULL
            AFTER created_by

        ");
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        /**
         * Database connection
         */
        $db = Connection::getInstance();

        /**
         * Reverse changes
         */
        $db->exec("

            ALTER TABLE services

            DROP COLUMN featured_image,

            DROP COLUMN created_by,

            DROP COLUMN updated_by

        ");
    }
}