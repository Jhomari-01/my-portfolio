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
        Schema::table('resumes', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->longText('profile_image_light')->nullable();
            $table->longText('profile_image_dark')->nullable();
            $table->longText('resume_pdf')->nullable();
            $table->text('career_objective')->nullable();
            $table->json('educational_background')->nullable();
            $table->json('work_experience')->nullable();
            $table->json('trainings')->nullable();
            $table->json('personal_info')->nullable();
            $table->json('references')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn([
                'name', 'address', 'contact', 'email', 
                'profile_image_light', 'profile_image_dark', 'resume_pdf',
                'career_objective', 'educational_background', 
                'work_experience', 'trainings', 'personal_info', 'references'
            ]);
        });
    }
};
