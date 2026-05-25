<?php

namespace App\Core\Database;

abstract class Migration
{
    abstract public function up();

    abstract public function down();
}