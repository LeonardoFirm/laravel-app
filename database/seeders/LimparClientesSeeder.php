<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class LimparClientesSeeder extends Seeder
{
    public function run()
    {
        Cliente::truncate();
    }
}
