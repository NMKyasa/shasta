<?php

use App\Core\Database\Connection;
use App\Core\Database\Migration;

class AlterProjectsAddAuditColumns
extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        $db =
            Connection::getInstance();

        $db->exec("

            ALTER TABLE projects

            ADD created_by BIGINT NULL
            AFTER status,

            ADD updated_by BIGINT NULL
            AFTER created_by

        ");
    }

    /**
     * Reverse migration
     */
    public function down()
    {
        $db =
            Connection::getInstance();

        $db->exec("

            ALTER TABLE projects

            DROP COLUMN created_by,

            DROP COLUMN updated_by

        ");
    }
}