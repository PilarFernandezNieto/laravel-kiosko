<?php


/** TODO:  php artisan migrate:refresh --seed : con este comando limpiamos las  migraciones y volvemos a ejecutar sin añadir datos de más */
namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategoriaSeeder::class);
        $this->call(ProductoSeeder::class);
    }
}
