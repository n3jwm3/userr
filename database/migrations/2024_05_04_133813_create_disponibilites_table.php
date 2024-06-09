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
        Schema::create('disponibilites', function (Blueprint $table) {
            $table->id();
            $table->date('jour');
            $table->string('crenaux');
            $table->unsignedBigInteger('enseignant_id')->unsigned()->nullable();
            $table->foreign('enseignant_id')->references('id')->on('users')
            ->onDelete("cascade")->onUpdate("cascade")->where('user_type', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilites');
    }
};
