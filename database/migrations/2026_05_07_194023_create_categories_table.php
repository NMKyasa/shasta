<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('categories', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Category name
             */
            $table->string('name');

            /**
             * SEO slug
             */
            $table->string('slug')
                ->unique();

            /**
             * Optional description
             */
            $table->text('description')
                ->nullable();

            /**
             * Category status
             */
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            /**
             * Indexes
             */
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
        Schema::dropIfExists('categories');
    }
}