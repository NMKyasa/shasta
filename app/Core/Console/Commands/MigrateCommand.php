<?php

namespace App\Core\Console\Commands;

use App\Core\Database\Connection;

class MigrateCommand
{
    public function handle()
    {
        $db = Connection::getInstance();

        $files = glob(
            __DIR__ . '/../../../../database/migrations/*.php'
        );

        sort($files);

        $executed = $db->query(
            "SELECT migration FROM migrations"
        )->fetchAll(\PDO::FETCH_COLUMN);

        $batch = time();

        foreach ($files as $file) {

            $migration = basename($file);

            if (in_array($migration, $executed)) {
                continue;
            }

            require_once $file;

            $className = pathinfo($migration, PATHINFO_FILENAME);

            $parts = explode('_', $className);

            $className = implode(
                '',
                array_map(
                    'ucfirst',
                    array_slice($parts, 4)
                )
            );

            if (!class_exists($className)) {

                echo "Class {$className} not found.\n";

                continue;
            }

            $instance = new $className();

            $instance->up();

            $stmt = $db->prepare("
                INSERT INTO migrations (migration, batch)
                VALUES (?, ?)
            ");

            $stmt->execute([$migration, $batch]);

            echo "Migrated: {$migration}\n";
        }
    }
}