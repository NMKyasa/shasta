<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('notifications', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Related user
             *
             * Notification recipient
             */
            $table->bigInteger('user_id')
                ->nullable();

            /**
             * Notification type
             *
             * Examples:
             * inquiry
             * security
             * system
             */
            $table->string('type');

            /**
             * Notification title
             */
            $table->string('title');

            /**
             * Notification message
             */
            $table->longText('message')
                ->nullable();

            /**
             * Optional action URL
             *
             * Example:
             * /admin/inquiries/5
             */
            $table->string('action_url')
                ->nullable();

            /**
             * Read/unread status
             */
            $table->boolean('is_read')
                ->default(0);

            /**
             * Notification priority
             */
            $table->enum('priority', [
                'low',
                'medium',
                'high'
            ])->default('medium');

            /**
             * Foreign key:
             * notifications.user_id → users.id
             */
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            /**
             * Indexes
             */
            $table->index('user_id');

            $table->index('type');

            $table->index('is_read');

            $table->index('priority');

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
        Schema::dropIfExists('notifications');
    }
}