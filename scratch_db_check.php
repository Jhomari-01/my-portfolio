<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Tables:\n";
foreach (DB::select('SHOW TABLES') as $table) {
    echo "- " . current((array)$table) . "\n";
}

echo "\nMigrations Status:\n";
foreach (DB::table('migrations')->get() as $m) {
    echo "- " . $m->migration . "\n";
}

echo "\nChecking 'resumes' table: " . (Schema::hasTable('resumes') ? 'EXISTS' : 'MISSING') . "\n";
