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
                ->on("users")->onDelete("cascade");

            $table->bigInteger('module_id')->constrained()->unsigned();
            $table->foreign('module_id')->references("id")
                ->on("modules")->onDelete("cascade");

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
