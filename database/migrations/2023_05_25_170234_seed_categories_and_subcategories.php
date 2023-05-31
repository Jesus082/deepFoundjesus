<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Subcategory;

class SeedCategoriesAndSubcategories extends Migration
{
    public function up()
    {
        $categories = [
            [
                'name' => 'Arte y Antigüedades',
                'subcategories' => [
                    'Pinturas',
                    'Esculturas',
                    'Grabados',
                    'Joyería antigua',
                    'Relojes antiguos',
                    'Muebles antiguos',
                ],
            ],
            [
                'name' => 'Coleccionables',
                'subcategories' => [
                    'Cromos y tarjetas coleccionables',
                    'Monedas y billetes antiguos',
                    'Sellos postales',
                    'Figuras de acción y juguetes antiguos',
                    'Álbumes y revistas antiguas',
                    'Ropa y Accesorios',
                ],
            ],
            [
                'name' => 'Ropa vintage',
                'subcategories' => [
                    'Accesorios de moda antiguos (bolsos, sombreros, gafas, etc.)',
                    'Relojes de pulsera vintage',
                ],
            ],
            [
                'name' => 'Vehículos y Piezas',
                'subcategories' => [
                    'Coches antiguos y clásicos',
                    'Motos antiguas',
                    'Piezas de repuesto para vehículos antiguos',
                ],
            ],
            [
                'name' => 'Objetos Curiosos',
                'subcategories' => [
                    'Artefactos históricos',
                    'Herramientas y utensilios antiguos',
                    'Objetos de decoración retro',
                ],
            ],
            [
                'name' => 'Libros y Documentos',
                'subcategories' => [
                    'Libros antiguos y raros',
                    'Mapas antiguos',
                    'Documentos históricos',
                ],
            ],
            [
                'name' => 'Instrumentos Musicales',
                'subcategories' => [
                    'Instrumentos musicales antiguos',
                    'Partituras y libros de música antiguos',
                ],
            ],
            [
                'name' => 'Decoración y Mobiliario',
                'subcategories' => [
                    'Lámparas y apliques antiguos',
                    'Cerámicas y porcelanas antiguas',
                    'Mobiliario de época',
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
            ]);
            foreach ($categoryData['subcategories'] as $subcategoryName) {
                $subcategory = Subcategory::create([
                    'name' => $subcategoryName,
                    'category_id' => $category->id,
                ]);
            }
        }
    }

    public function down()
    {
        Subcategory::truncate();
        Category::truncate();
    }
}
