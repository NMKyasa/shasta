<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('pages', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Page title
             */
            $table->string('title');

            /**
             * SEO slug
             *
             * Examples:
             * about-us
             * contact-us
             */
            $table->string('slug')
                ->unique();

            /**
             * Page summary/excerpt
             */
            $table->text('summary')
                ->nullable();

            /**
             * Main page content
             */
            $table->longText('body')
                ->nullable();

            /**
             * Optional page template
             *
             * Examples:
             * default
             * contact
             * landing
             */
            $table->string('template')
                ->nullable();

            /**
             * SEO meta title
             */
            $table->string('meta_title')
                ->nullable();

            /**
             * SEO meta description
             */
            $table->text('meta_description')
                ->nullable();

            /**
             * SEO keywords
             */
            $table->text('meta_keywords')
                ->nullable();

            /**
             * Canonical URL
             */
            $table->string('canonical_url')
                ->nullable();

            /**
             * Featured page
             */
            $table->boolean('featured')
                ->default(0);

            /**
             * Publish status
             */
            $table->enum('status', [
                'draft',
                'published',
                'archived'
            ])->default('draft');

            /**
             * Publish date
             */
            $table->string('published_at')
                ->nullable();

            /**
             * Indexes
             */
            $table->index('slug');

            $table->index('status');

            $table->index('featured');

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
        Schema::dropIfExists('pages');
    }
}