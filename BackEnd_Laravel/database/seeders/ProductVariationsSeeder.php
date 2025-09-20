<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class ProductVariationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //prodcutvariations
        $productVariations = [];

        //for sneakers
        for($i=33;$i<=45;$i++){
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "black",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "blue",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "blue",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "black",
                'stock' => 5,
            ];
        }

        //for caual shoes
        for($i=46;$i<=57;$i++){
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "black",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "white",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "white",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "black",
                'stock' => 5,
            ];
        }
        //for formal shoes;
        for($i=58;$i<=67;$i++){
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "black",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "brown",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "brown",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "black",
                'stock' => 5,
            ];
        }
        //for wedders
        for($i=68;$i<=78;$i++){
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "black",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "brown",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "black",
                'stock' => 5,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "brown",
                'stock' => 5,
            ];
        }
        //for home
        for($i=79;$i<=87;$i++){
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "black",
                'stock' => 10,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 43,
                'color' => "white",
                'stock' => 10,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "black",
                'stock' => 10,
            ];
            $productVariations[] = [
                'product_id' => $i,
                'size' => 44,
                'color' => "white",
                'stock' => 10,
            ];
        }
       //insert into database
        foreach ($productVariations as $productvariation) {
            ProductVariation::create($productvariation);
        }

    }
}
