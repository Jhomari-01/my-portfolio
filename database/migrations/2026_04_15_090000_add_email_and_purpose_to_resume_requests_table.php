<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('resume_requests', function (Blueprint $table) {
            $table->string('email')->after('id');
            $table->text('purpose')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resume_requests', function (Blueprint $table) {
            $table->dropColumn(['email', 'purpose']);
        });
    }
};
