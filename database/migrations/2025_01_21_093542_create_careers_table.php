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
        Schema::create('careers', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
            $table->string('career_name');
            $table->string('required_skills');
            $table->bigInteger('salary');
            $table->unsignedBigInteger('experience');
            $table->string('education_level');
            
           
            $table->foreignId('industry_id')->constrained('industries')->cascadeOnDelete()->cascadeOnUpdate();
            
          
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'careers');
    }
};