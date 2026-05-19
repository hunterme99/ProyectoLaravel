<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pasos', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->unsignedBigInteger('id_receta');

            $table->foreign('id_receta')->references('id')->on('receta')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasos');
    }
};
