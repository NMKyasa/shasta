<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreatePricingItemsTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('pricing_items', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Optional related service
             */
            $table->bigInteger('service_id')
                ->nullable();

            /**
             * Pricing title
             *
             * Examples:
             * Armed Guards
             * Search Mirror
             * K9
             */
            $table->string('title');

            /**
             * Optional pricing subtitle
             *
             * Examples:
             * Day Shift
             * Night Shift
             */
            $table->string('subtitle')
                ->nullable();

            /**
             * Pricing amount
             *
             * Example:
             * 600000
             */
            $table->decimal('price', 15, 2)
                ->nullable();

            /**
             * Currency
             *
             * Example:
             * UGX
             */
            $table->string('currency')
                ->default('UGX');

            /**
             * Pricing type
             *
             * fixed
             * negotiable
             */
            $table->enum('pricing_type', [
                'fixed',
                'negotiable'
            ])->default('fixed');

            /**
             * Pricing duration/period
             *
             * Examples:
             * per day
             * per shift
             * monthly
             */
            $table->string('pricing_period')
                ->nullable();

            /**
             * Optional description
             */
            $table->text('description')
                ->nullable();

            /**
             * Display ordering
             */
            $table->bigInteger('sort_order')
                ->default(0);

            /**
             * Featured pricing item
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
             * Foreign key:
             * pricing_items.service_id → services.id
             */
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('SET NULL');

            /**
             * Indexes
             */
            $table->index('service_id');

            $table->index('pricing_type');

            $table->index('featured');

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
        Schema::dropIfExists('pricing_items');
    }
}