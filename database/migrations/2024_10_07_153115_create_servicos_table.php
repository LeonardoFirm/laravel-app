<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('valor', 8, 2);
            $table->timestamps();
        });

        // Adicione serviços padrão
        DB::table('servicos')->insert([
            ['nome' => 'Lavagem Expressa', 'valor' => 89.00],
            ['nome' => 'Lavagem Premium', 'valor' => 129.00],
            ['nome' => 'Outras', 'valor' => 0.00],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('servicos');
    }
};
