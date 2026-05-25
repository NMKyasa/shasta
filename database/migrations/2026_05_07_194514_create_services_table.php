<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('services', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Service title
             */
            $table->string('title');

            /**
             * SEO slug
             *
             * Example:
             * web-development
             */
            $table->string('slug')
                ->unique();

            /**
             * Short summary/excerpt
             */
            $table->text('summary')
                ->nullable();

            /**
             * Full service content
             */
            $table->longText('body')
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
             * Featured service
             *
             * 1 = featured
             * 0 = normal
             */
            $table->boolean('featured')
                ->default(0);

            /**
             * Service status
             */
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

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
        Schema::dropIfExists('services');
    }
}