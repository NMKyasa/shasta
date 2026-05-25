<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('user_permissions', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Related user
             */
            $table->bigInteger('user_id');

            /**
             * Related permission
             */
            $table->bigInteger('permission_id');

            /**
             * Allow/deny override
             *
             * 1 = allow
             * 0 = deny
             */
            $table->boolean('allowed')
                ->default(1);

            /**
             * Foreign key:
             * user_permissions.user_id → users.id
             */
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            /**
             * Foreign key:
             * user_permissions.permission_id
             * → permissions.id
             */
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('CASCADE');

            /**
             * Indexes
             */
            $table->index('user_id');

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
        Schema::dropIfExists('user_permissions');
    }
}