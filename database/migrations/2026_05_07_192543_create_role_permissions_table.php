<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('role_permissions', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Role relationship
             */
            $table->bigInteger('role_id');

            /**
             * Permission relationship
             */
            $table->bigInteger('permission_id');

            /**
             * Foreign keys
             */
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('CASCADE');

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('CASCADE');

            /**
             * Indexes
             */
            $table->index('role_id');

            $table->index('permission_id');

            /**
             * Timestamps
             */
            $table->timestamps();
        });
    }

    /**
     * Reverse migration
     */
    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
}