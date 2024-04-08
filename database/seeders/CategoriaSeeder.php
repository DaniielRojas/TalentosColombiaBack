<?php

namespace Database\Seeders;
 // Corregido el nombre del modelo

use App\Models\Categorias;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Tecnología',
            'Negocios',
            'Diseño',
            'Desarrollo Personal',
            'Arte y Creatividad',
            'Marketing Digital',
            'Ciencia de Datos',
            'Educación',
            'Salud y Bienestar',
            'Idiomas',
            'Programación',
            'Finanzas',
            'Cocina y Gastronomía',
            'Viajes y Aventura',
            'Moda y Estilo',
            'Música',
            'Cine y Televisión',
            'Deportes y Fitness',
            'Medio Ambiente',
            'Historia',
            'Literatura',
            'Fotografía',
            'Matemáticas',
            'Psicología',
            'Espiritualidad',
            'Robótica',
            'Derecho',
            'Innovación',
            'Automatización'
        ];

        foreach ($categories as $category) {
            Categorias::create([
                'nombre' => $category
            ]);
        }
    }
}
