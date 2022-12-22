<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(['name' => 'Calha Corte 10', 'price' => '4.90', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 13', 'price' => '6.50', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 15', 'price' => '6.30', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 20', 'price' => '8.40', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 25', 'price' => '10.50', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 28', 'price' => '11.75', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 30', 'price' => '12.60', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 33', 'price' => '13.85', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 35', 'price' => '14.70', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 40', 'price' => '16.80', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 45', 'price' => '18.90', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 50', 'price' => '21.00', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 55', 'price' => '23.00', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 60', 'price' => '25.15', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 65', 'price' => '27.50', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 70', 'price' => '29.50', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 80', 'price' => '33.60', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 90', 'price' => '37.80', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 100', 'price' => '42.00', 'category' => 'METERS']);
        Product::create(['name' => 'Calha Corte 120', 'price' => '50.50', 'category' => 'METERS']);

        Product::create(['name' => 'Rufo Corte 10', 'price' => '4.90', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 13', 'price' => '6.50', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 15', 'price' => '6.30', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 20', 'price' => '8.40', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 25', 'price' => '10.50', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 28', 'price' => '11.75', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 30', 'price' => '12.60', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 33', 'price' => '13.85', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 35', 'price' => '14.70', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 40', 'price' => '16.80', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 45', 'price' => '18.90', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 50', 'price' => '21.00', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 55', 'price' => '23.00', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 60', 'price' => '25.15', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 65', 'price' => '27.50', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 70', 'price' => '29.50', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 80', 'price' => '33.60', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 90', 'price' => '37.80', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 100', 'price' => '42.00', 'category' => 'METERS']);
        Product::create(['name' => 'Rufo Corte 120', 'price' => '50.50', 'category' => 'METERS']);
        
        Product::create(['name' => 'Condutor 25', 'price' => '11.40', 'category' => 'METERS']);
        Product::create(['name' => 'Condutor 28', 'price' => '11.80', 'category' => 'METERS']);
        Product::create(['name' => 'Condutor 33', 'price' => '13.75', 'category' => 'METERS']);

        Product::create(['name' => 'PU', 'price' => '20.00', 'category' => 'UNIT']);
    }
}
