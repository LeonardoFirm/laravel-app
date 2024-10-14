<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('placa_veiculo')->nullable(); // ou `->string('placa_veiculo')` se não permitir nulos
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('placa_veiculo');
        });
    }

};
