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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->string('session');
            $table->string('duree');
            $table->bigInteger('module_id')->constrained()->unsigned();
            $table->bigInteger('local_id')->constrained()->unsigned();
            $table->bigInteger('crenau_id')->constrained()->unsigned();
            $table->foreign('module_id')->references("id")
            ->on("modules")->onDelete("cascade");
            $table->foreign('local_id')->references("id")
            ->on("locals")->onDelete("cascade");
            $table->foreign('crenau_id')->references("id")
            ->on("crenaus")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
