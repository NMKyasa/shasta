<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateAuditLogsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('audit_logs', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * User performing action
             */
            $table->bigInteger('user_id')
                ->nullable();

            /**
             * Action performed
             *
             * Examples:
             * create
             * update
             * delete
             * login
             */
            $table->string('action');

            /**
             * Related module
             *
             * Examples:
             * users
             * services
             * projects
             */
            $table->string('module');

            /**
             * Related record ID
             */
            $table->bigInteger('target_id')
                ->nullable();

            /**
             * Previous values
             * stored as JSON string
             */
            $table->longText('old_values')
                ->nullable();

            /**
             * New values
             * stored as JSON string
             */
            $table->longText('new_values')
                ->nullable();

            /**
             * IP address
             */
            $table->string('ip_address', 100)
                ->nullable();

            /**
             * Browser/device info
             */
            $table->longText('user_agent')
                ->nullable();

            /**
             * Log type
             *
             * security = super admin only
             * activity = admin-visible
             */
            $table->enum('log_type', [
                'security',
                'activity'
            ])->default('activity');

            /**
             * Foreign key:
             * audit_logs.user_id → users.id
             */
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');

            /**
             * Indexes
             */
            $table->index('user_id');

            $table->index('module');

            $table->index('action');

            $table->index('log_type');

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
        Schema::dropIfExists('audit_logs');
    }
}