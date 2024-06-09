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
        Schema::create('crenaus_locals', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('crenau_id')->constrained()->unsigned();
            $table->foreign('crenau_id')->references("id")
<<<<<<< HEAD:database/migrations/2024_06_08_130216_create_crenaus_locals_table.php
            ->on("crenaus")->onDelete("cascade");

            $table->bigInteger('local_id')->constrained()->unsigned();
=======
            ->on("crenaus")->onDelete("cascade")->onUpdate("cascade");
>>>>>>> 538687531b3f49132f3ed7eba8902d6cf1c8b57b:database/migrations/2024_12_03_015125_create_crenaus_locals_table.php
            $table->foreign('local_id')->references("id")
            ->on("locals")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crenaus_locals');
    }
};
