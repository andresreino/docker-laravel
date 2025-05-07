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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            // Crea campo "cliente_id", relacionado con "id" de la tabla 'users' (clave foránea)
            // Si usuario es borrado, se borran sus citas con onDelete('cascade')
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade');
            // Campos del coche
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula');
            // Campos opcionales (los pondrá el taller más tarde)
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->integer('duracion_estimada')->nullable(); // en minutos, por ejemplo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};