<?php

use App\Core\Database\Connection;
use App\Core\Database\Migration;

class AlterProjectsTable
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
         * Alter projects table
         */
        $db->exec("

            ALTER TABLE projects

            ADD scope LONGTEXT NULL
            AFTER completion_date,

            ADD impact LONGTEXT NULL
            AFTER scope

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
         * Reverse migration
         */
        $db->exec("

            ALTER TABLE projects

            DROP COLUMN scope,

            DROP COLUMN impact

        ");
    }
}