<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('projects', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Project title
             */
            $table->string('title');

            /**
             * SEO slug
             */
            $table->string('slug')
                ->unique();

            /**
             * Short summary/excerpt
             */
            $table->text('summary')
                ->nullable();

            /**
             * Full project content
             */
            $table->longText('body')
                ->nullable();

            /**
             * Client/company name
             */
            $table->string('client_name')
                ->nullable();

            /**
             * Project completion date
             */
            $table->string('completion_date')
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
             * Featured project
             */
            $table->boolean('featured')
                ->default(0);

            /**
             * Project visibility status
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
        Schema::dropIfExists('projects');
    }
}