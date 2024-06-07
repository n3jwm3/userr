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
            $table->bigInteger('local_id')->constrained()->unsigned();
            $table->foreign('crenau_id')->references("id")
            ->on("crenaus")->onDelete("cascade")->onUpdate("cascade");
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
