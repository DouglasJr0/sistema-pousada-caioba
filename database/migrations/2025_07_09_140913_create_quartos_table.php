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
    Schema::create('quartos', function (Blueprint $table) {
        $table->id();
        $table->string('numero')->unique();
        $table->string('tipo'); // suíte, casal, etc
        $table->integer('capacidade'); // nº de pessoas
        $table->decimal('valor_diaria', 8, 2);
        $table->enum('status', ['disponível', 'reservado', 'manutenção'])->default('disponível');
        $table->timestamps();
    });
}

};
