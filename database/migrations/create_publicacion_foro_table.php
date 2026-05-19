<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('publicacion_foro', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('contenido');
            $table->unsignedBigInteger('id_usuario');
            $table->timestamp('fecha')->useCurrent();

            $table->foreign('id_usuario')->references('id')->on('usuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publicacion_foro');
    }
};
