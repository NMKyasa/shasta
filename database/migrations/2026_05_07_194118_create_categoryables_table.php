<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateCategoryablesTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('categoryables', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Related category
             */
            $table->bigInteger('category_id');

            /**
             * Polymorphic type
             *
             * Examples:
             * services
             * projects
             */
            $table->string('categoryable_type');

            /**
             * Related model ID
             */
            $table->bigInteger('categoryable_id');

            /**
             * Foreign key:
             * categoryables.category_id
             * → categories.id
             */
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('CASCADE');

            /**
             * Indexes
             */
            $table->index('category_id');

            $table->index('categoryable_type');

            $table->index('categoryable_id');

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
        Schema::dropIfExists('categoryables');
    }
}