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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_medico');
            $table->unsignedBigInteger('id_paciente');
            $table->foreign('id_medico')->references('id')->on('medico');
            $table->foreign('id_paciente')->references('id')->on('paciente');
            $table->string('contenido');
            $table->string('archivos');         
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
