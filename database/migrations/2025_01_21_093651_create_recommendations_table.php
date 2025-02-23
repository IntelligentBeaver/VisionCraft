<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('survey_id')->constrained()->onDelete('cascade');
            $table->string('job_title');
            $table->string('industry');
            $table->string('functional_area');
            $table->string('role');
            $table->decimal('similarity_score', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommendations');
    }
};