<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductWarehouseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_warehouse')->insert([
            ['id'=>1,  'product_id'=>1,  'warehouse_id'=>1,  'location'=>'Berlicum',            'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>2,  'product_id'=>2,  'warehouse_id'=>2,  'location'=>'Rosmalen',            'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>3,  'product_id'=>3,  'warehouse_id'=>3,  'location'=>'Berlicum',            'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>4,  'product_id'=>4,  'warehouse_id'=>4,  'location'=>'Berlicum',            'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>5,  'product_id'=>5,  'warehouse_id'=>5,  'location'=>'Rosmalen',            'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>6,  'product_id'=>6,  'warehouse_id'=>6,  'location'=>'Berlicum',            'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>7,  'product_id'=>7,  'warehouse_id'=>7,  'location'=>'Rosmalen',            'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>8,  'product_id'=>8,  'warehouse_id'=>8,  'location'=>'Sint-MichelsGestel',  'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>9,  'product_id'=>9,  'warehouse_id'=>9,  'location'=>'Sint-MichelsGestel',  'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>10, 'product_id'=>10, 'warehouse_id'=>10, 'location'=>'Middelrode',          'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>11, 'product_id'=>11, 'warehouse_id'=>11, 'location'=>'Middelrode',          'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>12, 'product_id'=>12, 'warehouse_id'=>12, 'location'=>'Middelrode',          'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>13, 'product_id'=>13, 'warehouse_id'=>13, 'location'=>'Schijndel',           'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>14, 'product_id'=>14, 'warehouse_id'=>14, 'location'=>'Schijndel',           'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>15, 'product_id'=>15, 'warehouse_id'=>15, 'location'=>'Gemonde',             'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>16, 'product_id'=>16, 'warehouse_id'=>16, 'location'=>'Gemonde',             'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>17, 'product_id'=>17, 'warehouse_id'=>17, 'location'=>'Gemonde',             'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>18, 'product_id'=>18, 'warehouse_id'=>18, 'location'=>'Gemonde',             'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>19, 'product_id'=>19, 'warehouse_id'=>19, 'location'=>'Den Bosch',           'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>20, 'product_id'=>20, 'warehouse_id'=>20, 'location'=>'Den Bosch',           'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>21, 'product_id'=>21, 'warehouse_id'=>21, 'location'=>'Den Bosch',           'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>22, 'product_id'=>22, 'warehouse_id'=>22, 'location'=>'Heeswijk Dinther',    'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>23, 'product_id'=>23, 'warehouse_id'=>23, 'location'=>'Heeswijk Dinther',    'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>24, 'product_id'=>24, 'warehouse_id'=>24, 'location'=>'Heeswijk Dinther',    'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>25, 'product_id'=>25, 'warehouse_id'=>25, 'location'=>'Vught',               'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>26, 'product_id'=>26, 'warehouse_id'=>26, 'location'=>'Vught',               'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>27, 'product_id'=>27, 'warehouse_id'=>27, 'location'=>'Vught',               'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>28, 'product_id'=>28, 'warehouse_id'=>28, 'location'=>'Vught',               'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>29, 'product_id'=>29, 'warehouse_id'=>29, 'location'=>'Vught',               'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
