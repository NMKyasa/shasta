<?php

namespace App\Core\Console\Commands;

class MakeMigrationCommand
{
    public function handle($name)
    {
        if (!$name) {

            exit("Migration name is required.\n");
        }

        $timestamp = date('Y_m_d_His');

        $className = str_replace(
            ' ',
            '',
            ucwords(str_replace('_', ' ', $name))
        );

        $fileName = "{$timestamp}_{$name}.php";

        $path = __DIR__ .
            "/../../../../database/migrations/{$fileName}";

        $template = "<?php

use App\Core\Database\Migration;
use App\Core\Database\Connection;

class {$className} extends Migration
{
    public function up()
    {
        \$db = Connection::getInstance();

    }

    public function down()
    {
        \$db = Connection::getInstance();

    }
}
";

        file_put_contents($path, $template);

        echo "Migration created: {$fileName}\n";
    }
}