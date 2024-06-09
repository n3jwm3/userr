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
        Schema::create('crenaus_users', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2024_06_08_125553_create_crenaus_users_table.php

            $table->bigInteger('crenau_id')->constrained()->unsigned();
            $table->foreign('crenau_id')->references("id")
            ->on("crenaus")->onDelete("cascade");

            $table->bigInteger('user_id')->constrained()->unsigned();
            $table->foreign('user_id')->references("id")
            ->on("users")->onDelete("cascade");
=======
            $table->bigInteger('crenau_id')->constrained()->unsigned()->nullable();
            $table->bigInteger('user_id')->constrained()->unsigned()->nullable();
            $table->foreign('user_id')->references("id")
            ->on("users")->onDelete("cascade")->onUpdate("cascade")->where('user_type', 2);
            $table->foreign('crenau_id')->references("id")
            ->on("crenaus")->onDelete("cascade")->onUpdate("cascade");
>>>>>>> 538687531b3f49132f3ed7eba8902d6cf1c8b57b:database/migrations/2024_05_12_015212_create_crenaus_enseignants_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crenaus_users');
    }
};
