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
        Schema::create('motos_disponibles', function (Blueprint $table) {
            $table->integer('id_moto_disp')->autoIncrement();
            $table->string('nombre_clie_moto', 100)->nullable();
            $table->string('ciudad_clie_moto', 100)->nullable();
            $table->string('telefono_clie_moto', 15)->nullable();
            $table->string('correo_clie_moto', 100)->nullable();
            $table->string('nombre', 200)->nullable();
            $table->string('marca', 100)->nullable();
            $table->string('tipoMoto', 100)->nullable();
            $table->string('linea', 100)->nullable();
            $table->integer('modelo')->nullable();
            $table->string('kilometraje', 100)->nullable();
            $table->string('soat_tecno_matri', 500)->nullable();
            $table->string('descripcion', 4000)->nullable();
            $table->string('fotos', 1000)->nullable();
            $table->string('url_insta', 500)->nullable();
            $table->integer('valor')->nullable();
            $table->integer('moto_inv_ext')->default(1)->nullable();
            $table->integer('estado')->default(1)->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->string('ruta', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motos_disponibles');
    }
};
