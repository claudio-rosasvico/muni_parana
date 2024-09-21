<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            'Alfajores de maizena',
            'Arepas',
            'Baggette',
            'Bolas de fraile',
            'Bondiola',
            'Borlas',
            'Café',
            'Cerveza artesanal',
            'Cervezas',
            'Chipas',
            'Choripán',
            'Churro',
            'Crepes',
            'Donas',
            'Empanadas',
            'Garrapiñada',
            'Gaseosas',
            'Hamburguesas',
            'Helados',
            'Jugos naturales',
            'Lomitos',
            'Milanesas',
            'Pan casero',
            'Panchos',
            'Panificados',
            'Papas fritas',
            'Pastelería',
            'Pastelitos',
            'Piadinas',
            'Pizzas',
            'Pochoclo',
            'Postres',
            'Rebozados',
            'Salsas calientes',
            'Sandwichs',
            'Shawarma',
            'Tacos',
            'Taqueños',
            'Tortas fritas',
            'Tragos',
            'Waffles'
        ];

        foreach ($productos as $producto) {
            Producto::create([
                'nombre' => $producto,
                'observaciones' => ''
            ]);
        }
    }
}
