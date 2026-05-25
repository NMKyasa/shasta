<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('roles', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Parent role
             * for hierarchical inheritance
             */
            $table->bigInteger('parent_role_id')
                ->nullable();

            /**
             * Role name
             */
            $table->string('name')
                ->unique();

            /**
             * Optional description
             */
            $table->text('description')
                ->nullable();

            /**
             * Protect system roles
             */
            $table->boolean('is_system')
                ->default(0);

            /**
             * Role status
             */
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            /**
             * Self-referencing foreign key
             */
            $table->foreign('parent_role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('SET NULL');

            /**
             * Indexes
             */
            $table->index('parent_role_id');

            $table->index('status');

            /**
             * Timestamps
             */
            $table->timestamps();

            /**
             * Soft deletes
             */
            $table->softDeletes();
        });
    }

    /**
     * Reverse migration
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}