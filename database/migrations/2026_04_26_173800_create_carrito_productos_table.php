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
        Schema::create('carrito_productos', function (Blueprint $table) {
            $table->integer('id_carrito')->autoIncrement();
            $table->string('id_producto', 100);
            $table->integer('cantidad');
            $table->string('carrito_ref', 100)->unique();
            $table->string('usuario', 100);
            $table->integer('estado');
            $table->datetime('fch_registro')->useCurrent();
            $table->string('nombre_cli', 200)->nullable();
            $table->string('direccion_cli', 200)->nullable();
            $table->string('ciudad_cli', 100)->nullable();
            $table->string('telefono_cli', 50)->nullable();
            $table->string('correo_cli', 200)->nullable();
            $table->string('numeros', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_productos');
    }
};
