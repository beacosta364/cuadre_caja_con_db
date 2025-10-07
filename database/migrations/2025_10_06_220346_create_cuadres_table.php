<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('cuadres', function (Blueprint $table) {
        $table->id();
        $table->date('fecha');
        $table->decimal('total_venta', 12, 2)->nullable();
        $table->decimal('propina', 12, 2)->nullable();
        $table->decimal('domicilio', 12, 2)->nullable();
        $table->decimal('red1', 12, 2)->nullable();
        $table->decimal('red2', 12, 2)->nullable();
        $table->decimal('red3', 12, 2)->nullable();
        $table->decimal('red4', 12, 2)->nullable();
        $table->decimal('red5', 12, 2)->nullable();
        $table->decimal('red6', 12, 2)->nullable();
        $table->decimal('transferencias', 12, 2)->nullable();
        $table->decimal('cuenta_cobrar', 12, 2)->nullable();
        $table->decimal('gastos', 12, 2)->nullable();
        $table->decimal('efectivo_oficina', 12, 2)->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuadres');
    }
};
