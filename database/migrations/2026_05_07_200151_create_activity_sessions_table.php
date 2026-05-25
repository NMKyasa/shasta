<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateActivitySessionsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('activity_sessions', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Related user
             */
            $table->bigInteger('user_id');

            /**
             * Unique session token
             */
            $table->string('session_token')
                ->unique();

            /**
             * IP address
             */
            $table->string('ip_address', 100)
                ->nullable();

            /**
             * Browser/device information
             */
            $table->longText('user_agent')
                ->nullable();

            /**
             * Login timestamp
             */
            $table->string('logged_in_at')
                ->nullable();

            /**
             * Last activity timestamp
             */
            $table->string('last_activity_at')
                ->nullable();

            /**
             * Session expiration timestamp
             */
            $table->string('expires_at')
                ->nullable();

            /**
             * Session status
             */
            $table->enum('status', [
                'active',
                'expired',
                'revoked'
            ])->default('active');

            /**
             * Foreign key:
             * activity_sessions.user_id → users.id
             */
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            /**
             * Indexes
             */
            $table->index('user_id');

            $table->index('status');

            $table->index('last_activity_at');

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
        Schema::dropIfExists('activity_sessions');
    }
}