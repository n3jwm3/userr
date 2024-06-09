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
        Schema::create('crenaus', function (Blueprint $table) {
            $table->id();
            $table->enum('crenaux', ['08h-10h', '10h-12h', '12h-14h','14h-16h']);
            $table->bigInteger('jour_id')->constrained()->unsigned();
            $table->foreign('jour_id')->references("id")
            ->on("jours")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crenaus');
    }
};
