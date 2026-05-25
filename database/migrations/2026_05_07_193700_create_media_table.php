<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('media', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Polymorphic relationship type
             *
             * Examples:
             * services
             * projects
             * team
             */
            $table->string('mediable_type');

            /**
             * Related record ID
             */
            $table->bigInteger('mediable_id');

            /**
             * Original file name
             */
            $table->string('file_name');

            /**
             * Stored file path
             */
            $table->string('file_path');

            /**
             * File MIME type
             *
             * Examples:
             * image/jpeg
             * image/png
             */
            $table->string('mime_type')
                ->nullable();

            /**
             * File size in bytes
             */
            $table->bigInteger('file_size')
                ->nullable();

            /**
             * SEO/image accessibility
             */
            $table->string('alt_text')
                ->nullable();

            /**
             * Optional caption
             */
            $table->text('caption')
                ->nullable();

            /**
             * Featured image
             *
             * 1 = featured
             * 0 = normal
             */
            $table->boolean('is_featured')
                ->default(0);

            /**
             * Image ordering
             */
            $table->bigInteger('sort_order')
                ->default(0);

            /**
             * Media status
             */
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            /**
             * Indexes
             */
            $table->index('mediable_type');

            $table->index('mediable_id');

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
        Schema::dropIfExists('media');
    }
}