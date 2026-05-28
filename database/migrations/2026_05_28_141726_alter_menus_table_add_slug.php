<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;
use App\Core\Database\Connection;

class AlterMenusTableAddSlug
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
         * Add slug column
         */
        $db->exec("

            ALTER TABLE menus

            ADD slug VARCHAR(255)
            NULL

            AFTER name

        ");

        /**
         * Add index
         */
        $db->exec("

            ALTER TABLE menus

            ADD INDEX menus_slug_index (slug)

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

            DROP INDEX menus_slug_index

        ");

        /**
         * Drop column
         */
        $db->exec("

            ALTER TABLE menus

            DROP COLUMN slug

        ");
    }
}