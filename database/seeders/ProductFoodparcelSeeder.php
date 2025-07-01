<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductFoodparcelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_foodparcel')->insert([
            ['id'=>1,  'foodparcel_id'=>1, 'product_id'=>7,  'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>2,  'foodparcel_id'=>1, 'product_id'=>8,  'product_unit_count'=>2, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>3,  'foodparcel_id'=>1, 'product_id'=>9,  'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>4,  'foodparcel_id'=>2, 'product_id'=>12, 'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>5,  'foodparcel_id'=>2, 'product_id'=>13, 'product_unit_count'=>2, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>6,  'foodparcel_id'=>2, 'product_id'=>14, 'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>7,  'foodparcel_id'=>3, 'product_id'=>3,  'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>8,  'foodparcel_id'=>4, 'product_id'=>4,  'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>9,  'foodparcel_id'=>4, 'product_id'=>20, 'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>10, 'foodparcel_id'=>4, 'product_id'=>19, 'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>11, 'foodparcel_id'=>4, 'product_id'=>21, 'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>12, 'foodparcel_id'=>5, 'product_id'=>24, 'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>13, 'foodparcel_id'=>5, 'product_id'=>25, 'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>14, 'foodparcel_id'=>5, 'product_id'=>26, 'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>15, 'foodparcel_id'=>6, 'product_id'=>26, 'product_unit_count'=>1, 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
