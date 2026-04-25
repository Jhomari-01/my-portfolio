<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$missingMigrations = [
    '2026_04_20_063203_create_resumes_table',
    '2026_04_20_063204_create_portfolio_settings_table',
    '2026_04_20_070202_create_about_images_table',
    '2026_04_20_070254_create_admin_credentials_table',
    '2026_04_24_052927_add_image_to_about_images_table'
];

echo "Cleaning up migrations for missing tables...\n";
foreach ($missingMigrations as $m) {
    DB::table('migrations')->where('migration', $m)->delete();
    echo "Deleted migration record: $m\n";
}

echo "\nNow you can run php artisan migrate.\n";
