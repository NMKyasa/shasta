<?php

use App\Core\Database\Migration;
use App\Core\Database\Connection;

class CreateMediablesTable extends Migration
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
         * Create mediables table
         */
        $db->exec("

            CREATE TABLE mediables (

                id BIGINT AUTO_INCREMENT PRIMARY KEY,

                media_id BIGINT NOT NULL,

                mediable_type VARCHAR(100) NOT NULL,

                mediable_id BIGINT NOT NULL,

                created_at TIMESTAMP NULL,

                updated_at TIMESTAMP NULL

            )

        ");
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        $db = Connection::getInstance();

        $db->exec("
            DROP TABLE IF EXISTS mediables
        ");
    }
}