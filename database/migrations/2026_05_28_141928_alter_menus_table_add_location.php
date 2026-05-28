<?php

use App\Core\Database\Migration;
use App\Core\Database\Connection;

class AlterMenusTableAddLocation
extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Add location column
         */
        $db->exec("

            ALTER TABLE menus

            ADD location VARCHAR(255)
            NOT NULL
            DEFAULT 'header'

            AFTER slug

        ");

        /**
         * Add index
         */
        $db->exec("

            ALTER TABLE menus

            ADD INDEX menus_location_index (location)

        ");
    }

    /**
     * Reverse migration
     */
    public function down()
    {
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Drop index
         */
        $db->exec("

            ALTER TABLE menus

            DROP INDEX menus_location_index

        ");

        /**
         * Drop column
         */
        $db->exec("

            ALTER TABLE menus

            DROP COLUMN location

        ");
    }
}