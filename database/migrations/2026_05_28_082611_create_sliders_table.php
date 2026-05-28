<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateSlidersTable
extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('sliders', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Slider title
             */
            $table->string('title');

            /**
             * Slider subtitle
             */
            $table->text('subtitle');

            /**
             * Button text
             */
            $table->string('button_text');

            /**
             * Button URL
             */
            $table->string('button_url');

            /**
             * Display ordering
             */
            $table->bigInteger('sort_order')
                ->default(0);

            /**
             * Featured slider
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
        Schema::dropIfExists(
            'sliders'
        );
    }
}