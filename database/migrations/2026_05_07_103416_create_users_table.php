<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('users', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * User role relationship
             */
            $table->bigInteger('role_id');

            /**
             * User names
             */
            $table->string('first_name');

            $table->string('last_name');

            /**
             * Unique email
             */
            $table->string('email')->unique();

            /**
             * Password hash
             */
            $table->string('password');

            /**
             * User status
             */
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            /**
             * Add timestamps
             */
            $table->timestamps();

            /**
             * Add foreign key
             */
            $table->foreign('role_id')
                ->references('id')
                ->on('roles');
        });
    }

    /**
     * Reverse migration
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}