<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rover_info', function (Blueprint $table) {
            $table->id();
            $table->string('rover_name');
            $table->integer('max_sol');
            $table->date('max_date');
            $table->string('status');
            $table->integer('total_photos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rover_info');
    }
};
