<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('respuesta_foro', function (Blueprint $table) {
            $table->id();
            $table->text('comentario');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_publicacion');
            $table->timestamp('fecha')->useCurrent();

            $table->foreign('id_usuario')->references('id')->on('usuario')->onDelete('cascade');
            $table->foreign('id_publicacion')->references('id')->on('publicacion_foro')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('respuesta_foro');
    }
};
