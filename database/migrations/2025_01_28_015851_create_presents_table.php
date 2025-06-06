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
        Schema::create('presents', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome do presente
            $table->string('description')->nullable(); // Descrição opcional
            $table->boolean('is_selected')->default(false); // Se foi escolhido
            $table->string('selected_by')->nullable(); // Nome do doador
            $table->string('selected_by_phone')->nullable(); // Telefone do doador
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presents');
    }
};
