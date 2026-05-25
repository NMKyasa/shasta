<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreatePageSectionsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('page_sections', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Related page
             */
            $table->bigInteger('page_id');

            /**
             * Section name/title
             *
             * Examples:
             * Hero Banner
             * CTA Section
             */
            $table->string('title')
                ->nullable();

            /**
             * Section type
             *
             * Examples:
             * hero
             * cta
             * gallery
             * features
             */
            $table->string('section_type');

            /**
             * Section identifier
             *
             * Useful for frontend rendering
             */
            $table->string('section_key')
                ->nullable();

            /**
             * Main content
             *
             * Stored as JSON or HTML
             */
            $table->longText('content')
                ->nullable();

            /**
             * Display order
             */
            $table->bigInteger('sort_order')
                ->default(0);

            /**
             * Active/inactive visibility
             */
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            /**
             * Foreign key:
             * page_sections.page_id → pages.id
             */
            $table->foreign('page_id')
                ->references('id')
                ->on('pages')
                ->onDelete('CASCADE');

            /**
             * Indexes
             */
            $table->index('page_id');

            $table->index('section_type');

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
        Schema::dropIfExists('page_sections');
    }
}