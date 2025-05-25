<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            // Crea campo "coche_id", relacionado con "id" de la tabla 'coches' (clave foránea)
            // Si coche es borrado, se borran sus citas con onDelete('cascade')
            $table->foreignId('coche_id')->constrained('coches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['coche_id']);
            $table->dropColumn('coche_id');
        });
    }

};
