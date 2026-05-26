<?php

use App\Core\Database\Connection;
use App\Core\Database\Migration;

class AlterPricingItemsAddAuditColumns
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
         * Add audit columns
         */
        $db->exec("

            ALTER TABLE pricing_items

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
        /**
         * Database connection
         */
        $db =
            Connection::getInstance();

        /**
         * Remove audit columns
         */
        $db->exec("

            ALTER TABLE pricing_items

            DROP COLUMN created_by,

            DROP COLUMN updated_by

        ");
    }
}