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
<<<<<<< HEAD:database/migrations/2024_06_08_130024_create_examens_users_table.php
            $table->foreign('examen_id')->references("id")
            ->on("examens")->onDelete("cascade");

            $table->bigInteger('user_id')->constrained()->unsigned();
            $table->foreign('user_id')->references("id")
            ->on("users")->onDelete("cascade");
=======
           // $table->foreignId('enseignant_id')->constrained()->unsigned();
            $table->bigInteger('user_id')->constrained()->unsigned()->nullable();
            $table->foreign('user_id')->references("id")
            ->on("users")->onDelete("cascade")->onUpdate("cascade")->where('user_type', 2);
            $table->foreign('examen_id')->references("id")
            ->on("examens")->onDelete("cascade")->onUpdate("cascade");
>>>>>>> 538687531b3f49132f3ed7eba8902d6cf1c8b57b:database/migrations/2024_05_12_015350_create_examens_enseignants_table.php
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
