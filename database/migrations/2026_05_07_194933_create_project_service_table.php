<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateProjectServiceTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('project_service', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Related project
             */
            $table->bigInteger('project_id');

            /**
             * Related service
             */
            $table->bigInteger('service_id');

            /**
             * Foreign key:
             * project_service.project_id → projects.id
             */
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('CASCADE');

            /**
             * Foreign key:
             * project_service.service_id → services.id
             */
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('CASCADE');

            /**
             * Indexes
             */
            $table->index('project_id');

            $table->index('service_id');

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
        Schema::dropIfExists('project_service');
    }
}