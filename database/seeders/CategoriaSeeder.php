<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // Pega as categorias do seu Enum Java
        $categorias = [
            'ALIMENTACAO',
            'TRANSPORTE',
            'LAZER',
            'SAUDE',
            'OUTROS'
        ];

        foreach ($categorias as $nome) {
            Categoria::create(['nome' => $nome]);
        }
    }
}