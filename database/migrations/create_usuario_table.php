<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->string('rol')->default('usuario');
            $table->timestamp('fecha_registro')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
