<?php

use App\Core\Database\Migration;
use App\Core\Database\Schema;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run migration
     */
    public function up()
    {
        Schema::create('team_members', function ($table) {

            /**
             * Primary key
             */
            $table->id();

            /**
             * Full name
             */
            $table->string('name');

            /**
             * Job title/position
             *
             * Examples:
             * CEO
             * Developer
             * Designer
             */
            $table->string('position')
                ->nullable();

            /**
             * Short biography
             */
            $table->longText('bio')
                ->nullable();

            /**
             * Email address
             */
            $table->string('email')
                ->nullable();

            /**
             * Phone number
             */
            $table->string('phone')
                ->nullable();

            /**
             * Social links
             */
            $table->string('facebook_url')
                ->nullable();

            $table->string('twitter_url')
                ->nullable();

            $table->string('linkedin_url')
                ->nullable();

            $table->string('instagram_url')
                ->nullable();

            /**
             * Display ordering
             */
            $table->bigInteger('sort_order')
                ->default(0);

            /**
             * Featured member
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
        Schema::dropIfExists('team_members');
    }
}