<?php

require_once 'bootstrap/app.php';

use App\Core\Database\Connection;

$db = Connection::getInstance();

echo "Database connected successfully!";