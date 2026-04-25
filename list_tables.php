<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = DB::select('SHOW TABLES');
echo "TOTAL TABLES: " . count($tables) . "\n";
foreach ($tables as $table) {
    $tableName = current((array)$table);
    echo "TABLE: $tableName\n";
}
