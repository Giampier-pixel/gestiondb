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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',200);
            $table->date('fecha');
            $table->string('address', 80)->nullable();
            $table->string('url')->nullable();
            $table->boolean('control')->default(false);
            $table->timestamps();
        });

        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('evento_id');
            $table->string('ponencia')->nullable();
            $table->unsignedTinyInteger('tipo_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->foreign('tipo_id')->references('id')->on('tipos');
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
        Schema::dropIfExists('participantes');
    }
};
