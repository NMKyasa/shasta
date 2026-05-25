<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('permissions', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Permission module
             *
             * Example:
             * users
             * services
             * projects
             */
            $table->string('module');

            /**
             * Permission action
             *
             * Example:
             * create
             * edit
             * delete
             */
            $table->string('action');

            /**
             * Unique permission name
             *
             * Example:
             * users.create
             */
            $table->string('name')
                ->unique();

            /**
             * Optional description
             */
            $table->text('description')
                ->nullable();

            /**
             * Timestamps
             */
            $table->timestamps();

            /**
             * Indexes
             */
            $table->index('module');

            $table->index('action');
        });
    }

    /**
     * Reverse migration
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}