<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateImpactsTable
extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('impacts', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Impact label
             */
            $table->string('label');

            /**
             * Impact value
             */
            $table->string('value');

            /**
             * Sort order
             */
            $table->bigInteger('sort_order')
                ->default(0);

            /**
             * Status
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
        Schema::dropIfExists(
            'impacts'
        );
    }
}