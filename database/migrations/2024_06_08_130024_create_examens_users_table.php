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
        Schema::create('examens_users', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('examen_id')->constrained()->unsigned();
            $table->foreign('examen_id')->references("id")
                ->on("examens")->onDelete("cascade");

            $table->bigInteger('user_id')->constrained()->unsigned();
            $table->foreign('user_id')->references("id")
                ->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens_users');
    }
};
