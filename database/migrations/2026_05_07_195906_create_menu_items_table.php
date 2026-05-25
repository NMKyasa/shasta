<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('menu_items', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Related menu
             */
            $table->bigInteger('menu_id');

            /**
             * Parent menu item
             *
             * Supports dropdowns/submenus
             */
            $table->bigInteger('parent_id')
                ->nullable();

            /**
             * Display label
             */
            $table->string('label');

            /**
             * URL/path
             *
             * Examples:
             * /services
             * /about-us
             */
            $table->string('url');

            /**
             * Optional target
             *
             * Examples:
             * _self
             * _blank
             */
            $table->string('target')
                ->default('_self');

            /**
             * Optional icon class
             *
             * Example:
             * fas fa-home
             */
            $table->string('icon')
                ->nullable();

            /**
             * Sort ordering
             */
            $table->bigInteger('sort_order')
                ->default(0);

            /**
             * Visibility status
             */
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            /**
             * Foreign key:
             * menu_items.menu_id → menus.id
             */
            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->onDelete('CASCADE');

            /**
             * Self-referencing dropdown hierarchy
             */
            $table->foreign('parent_id')
                ->references('id')
                ->on('menu_items')
                ->onDelete('SET NULL');

            /**
             * Indexes
             */
            $table->index('menu_id');

            $table->index('parent_id');

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
        Schema::dropIfExists('menu_items');
    }
}