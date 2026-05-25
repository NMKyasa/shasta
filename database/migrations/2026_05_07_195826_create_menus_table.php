<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('menus', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Menu name
             *
             * Examples:
             * Main Menu
             * Footer Menu
             */
            $table->string('name');

            /**
             * Unique menu key
             *
             * Examples:
             * main_menu
             * footer_menu
             */
            $table->string('menu_key')
                ->unique();

            /**
             * Menu description
             */
            $table->text('description')
                ->nullable();

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
        Schema::dropIfExists('menus');
    }
}
