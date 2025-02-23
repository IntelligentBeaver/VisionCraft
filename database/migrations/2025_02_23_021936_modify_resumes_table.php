<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            // Drop unnecessary columns
            $table->dropColumn(['file_path', 'parsed_skills', 'parsed_experience', 'ats_score']);

            // Rename file_path to filename (if needed)
            $table->string('filename')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            // Re-add the removed columns in case of rollback
            $table->string('file_path')->nullable();
            $table->string('parsed_skills')->nullable();
            $table->string('parsed_experience')->nullable();
            $table->unsignedBigInteger('ats_score')->default(0);
        });
    }
};