<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('testimonials', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Client/customer name
             */
            $table->string('name');

            /**
             * Company or organization
             */
            $table->string('company')
                ->nullable();

            /**
             * Job title/position
             */
            $table->string('position')
                ->nullable();

            /**
             * Testimonial content
             */
            $table->longText('message');

            /**
             * Rating value
             *
             * Examples:
             * 1–5
             */
            $table->bigInteger('rating')
                ->default(5);

            /**
             * Display ordering
             */
            $table->bigInteger('sort_order')
                ->default(0);

            /**
             * Featured testimonial
             */
            $table->boolean('featured')
                ->default(0);

            /**
             * Visibility status
             */
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            /**
             * Indexes
             */
            $table->index('status');

            $table->index('featured');

            $table->index('rating');

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
        Schema::dropIfExists('testimonials');
    }
}