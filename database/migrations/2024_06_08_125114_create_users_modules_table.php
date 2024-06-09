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
        Schema::create('users_modules', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->constrained()->unsigned();
            $table->foreign('user_id')->references("id")
<<<<<<< HEAD:database/migrations/2024_06_08_125114_create_users_modules_table.php
            ->on("users")->onDelete("cascade");

            $table->bigInteger('module_id')->constrained()->unsigned();
            $table->foreign('module_id')->references("id")
            ->on("modules")->onDelete("cascade");
=======
            ->on("users")->onDelete("cascade")->onUpdate("cascade")->where('user_type', 2);

            $table->bigInteger('module_id')->constrained()->unsigned();
            $table->foreign('module_id')->references("id")
            ->on("modules")->onDelete("cascade")->onUpdate("cascade");

>>>>>>> 538687531b3f49132f3ed7eba8902d6cf1c8b57b:database/migrations/2024_05_10_161333_create_users_modules_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_modules');
    }
};
