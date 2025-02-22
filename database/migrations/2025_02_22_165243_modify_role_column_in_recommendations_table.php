<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->text('role')->change(); // Changing role column from VARCHAR to TEXT
        });
    }

    public function down()
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->string('role', 255)->change(); // Revert back to VARCHAR(255) if needed
        });
    }
};