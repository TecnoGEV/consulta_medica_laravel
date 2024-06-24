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
        Schema::create('plantao_medicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('inicio_plantao');
            $table->dateTime('fim_plantao')->nullable();//deve ser atualizado quando a sessao do medico encerrar
            $table->dateTime('fim_plantao_previsto');
            $table->dateTime('excedente_plantao')->nullable(); // deve preencher com o horário atual se maior que fim plantão o plantão foi excedido
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantao_medicos');
    }
};
