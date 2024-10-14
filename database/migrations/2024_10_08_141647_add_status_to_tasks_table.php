<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTasksTable extends Migration
{
    public function up()
    {
        // Verifica se a coluna 'status' já existe
        if (!Schema::hasColumn('tasks', 'status')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->string('status')->default('não iniciada')->after('servico_id'); // Ajuste conforme necessário
            });
        }
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
