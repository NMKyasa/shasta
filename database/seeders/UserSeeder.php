<?php

use App\Core\Database\Seeder;
use App\Core\Database\Connection;

class UserSeeder extends Seeder
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
         * Insert super admin
         */
        $query = $db->prepare(
            "
            INSERT INTO users (

                role_id,
                first_name,
                last_name,
                email,
                password,
                status,
                created_at

            ) VALUES (

                ?, ?, ?, ?, ?, ?, NOW()

            )
            "
        );

        $query->execute([

            1,

            'Super',

            'Admin',

            'admin@shasta.com',

            password_hash(
                '123456',
                PASSWORD_DEFAULT
            ),

            'active'
        ]);

        echo "Super admin seeded successfully.\n";
    }
}