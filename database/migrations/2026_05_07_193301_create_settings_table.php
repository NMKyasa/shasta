<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('settings', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Unique setting key
             *
             * Examples:
             * site_name
             * smtp_host
             * company_email
             */
            $table->string('setting_key')
                ->unique();

            /**
             * Setting value
             */
            $table->longText('setting_value')
                ->nullable();

            /**
             * Setting group/category
             *
             * Examples:
             * general
             * smtp
             * seo
             */
            $table->string('setting_group')
                ->nullable();

            /**
             * Automatically load
             * during application bootstrap
             *
             * 1 = autoload
             * 0 = lazy load later
             */
            $table->boolean('autoload')
                ->default(1);

            /**
             * Indexes
             */
            $table->index('setting_group');

            $table->index('autoload');

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
        Schema::dropIfExists('settings');
    }
}