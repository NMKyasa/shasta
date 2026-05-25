<?php

namespace App\Core\Console\Commands;

/**
 * Database Seeder Command
 */
class SeedCommand
{
    /**
     * Run seeders
     */
    public function handle()
    {
        /**
         * Ordered seeders
         */
        $seeders = [

            'RoleSeeder',

            'UserSeeder'
        ];

        /**
         * Seeders path
         */
        $path =
            __DIR__
            .
            '/../../../../database/seeders/';

        /**
         * Run seeders
         */
        foreach ($seeders as $seeder) {

            /**
             * Load seeder file
             */
            require_once
                $path
                .
                $seeder
                .
                '.php';

            /**
             * Create seeder
             */
            $instance = new $seeder();

            /**
             * Run seeder
             */
            $instance->run();
        }

        echo "Database seeding completed.\n";
    }
}