<?php

use App\Core\Database\Seeder;
use App\Core\Database\Connection;

class RoleSeeder extends Seeder
{
    /**
     * Run seeder
     */
    public function run()
    {
        /**
         * Database connection
         */
        $db = Connection::getInstance();

        /**
         * Insert Super Admin role
         */
        $query = $db->prepare(
            "
            INSERT INTO roles (

                name,
                description,
                created_at

            ) VALUES (

                ?, ?, NOW()

            )
            "
        );

        $query->execute([

            'Super Admin',

            'Full system access'
        ]);

        echo "Roles seeded successfully.\n";
    }
}