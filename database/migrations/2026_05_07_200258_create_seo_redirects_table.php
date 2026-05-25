<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateSeoRedirectsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('seo_redirects', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Old/original URL
             *
             * Example:
             * /services/web-design
             */
            $table->string('from_url')
                ->unique();

            /**
             * Destination URL
             *
             * Example:
             * /services/ui-ux-design
             */
            $table->string('to_url');

            /**
             * Redirect type
             *
             * 301 = permanent
             * 302 = temporary
             */
            $table->enum('redirect_type', [
                '301',
                '302'
            ])->default('301');

            /**
             * Optional notes
             */
            $table->text('notes')
                ->nullable();

            /**
             * Redirect status
             */
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            /**
             * Redirect hit count
             *
             * Useful for analytics
             */
            $table->bigInteger('hit_count')
                ->default(0);

            /**
             * Last accessed timestamp
             */
            $table->string('last_accessed_at')
                ->nullable();

            /**
             * Indexes
             */
            $table->index('redirect_type');

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
        Schema::dropIfExists('seo_redirects');
    }
}