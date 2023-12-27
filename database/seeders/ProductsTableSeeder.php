<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Product::Factory()->count(10)->create();
    }

    //     Product::create([
    //         'company_id'=>'1',
    //         'product_name'=>'おいしいみず',
    //         'price'=> '300',
    //         'stock'=> '100',
    //     ]);

    //     Product::create([
    //         'company_id'=>'2',
    //         'product_name'=>'みかんジュース',
    //         'price'=> '280',
    //         'stock'=> '555',
    //     ]);

    //     Product::create([
    //         'company_id'=>'1',
    //         'product_name'=>'ミルク',
    //         'price'=> '250',
    //         'stock'=> '20',
    //     ]);

    // }
}
