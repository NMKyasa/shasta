<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateInquiriesTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('inquiries', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Inquiry type
             *
             * Examples:
             * contact
             * quote
             * consultation
             */
            $table->string('inquiry_type');

            /**
             * Sender name
             */
            $table->string('name');

            /**
             * Sender email
             */
            $table->string('email');

            /**
             * Sender phone number
             */
            $table->string('phone')
                ->nullable();

            /**
             * Inquiry subject
             */
            $table->string('subject')
                ->nullable();

            /**
             * Main message
             */
            $table->longText('message');

            /**
             * Optional related service
             */
            $table->bigInteger('service_id')
                ->nullable();

            /**
             * Optional related project
             */
            $table->bigInteger('project_id')
                ->nullable();

            /**
             * Inquiry processing status
             */
            $table->enum('status', [
                'new',
                'in_progress',
                'resolved',
                'closed'
            ])->default('new');

            /**
             * Admin notes/internal remarks
             */
            $table->longText('admin_notes')
                ->nullable();

            /**
             * Foreign key:
             * inquiries.service_id → services.id
             */
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('SET NULL');

            /**
             * Foreign key:
             * inquiries.project_id → projects.id
             */
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('SET NULL');

            /**
             * Indexes
             */
            $table->index('inquiry_type');

            $table->index('status');

            $table->index('service_id');

            $table->index('project_id');

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
        Schema::dropIfExists('inquiries');
    }
}