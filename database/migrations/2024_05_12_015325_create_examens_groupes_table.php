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
        Schema::create('examens_groupes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('examen_id')->constrained()->unsigned();
            $table->bigInteger('groupe_id')->constrained()->unsigned();
            $table->foreign('groupe_id')->references("id")
                ->on("groupes")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('examen_id')->references("id")
                ->on("examens")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens_groupes');
    }
};
