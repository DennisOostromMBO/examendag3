<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_supplier')->insert([
            ['id'=>1,  'supplier_id'=>4, 'product_id'=>1,  'delivered_at'=>'2024-04-12', 'next_delivery_at'=>'2024-05-12', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>2,  'supplier_id'=>4, 'product_id'=>2,  'delivered_at'=>'2024-03-02', 'next_delivery_at'=>'2024-04-02', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>3,  'supplier_id'=>2, 'product_id'=>3,  'delivered_at'=>'2024-07-16', 'next_delivery_at'=>'2024-08-16', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>4,  'supplier_id'=>1, 'product_id'=>4,  'delivered_at'=>'2024-02-12', 'next_delivery_at'=>'2024-03-12', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>5,  'supplier_id'=>4, 'product_id'=>5,  'delivered_at'=>'2024-05-19', 'next_delivery_at'=>'2024-06-19', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>6,  'supplier_id'=>1, 'product_id'=>6,  'delivered_at'=>'2024-06-23', 'next_delivery_at'=>'2024-07-23', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>7,  'supplier_id'=>4, 'product_id'=>7,  'delivered_at'=>'2024-06-20', 'next_delivery_at'=>'2024-07-20', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>8,  'supplier_id'=>4, 'product_id'=>8,  'delivered_at'=>'2024-05-02', 'next_delivery_at'=>'2024-06-02', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>9,  'supplier_id'=>4, 'product_id'=>9,  'delivered_at'=>'2022-12-04', 'next_delivery_at'=>'2024-01-04', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>10, 'supplier_id'=>3, 'product_id'=>10, 'delivered_at'=>'2024-03-07', 'next_delivery_at'=>'2024-04-07', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>11, 'supplier_id'=>3, 'product_id'=>11, 'delivered_at'=>'2024-02-04', 'next_delivery_at'=>'2024-03-04', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>12, 'supplier_id'=>3, 'product_id'=>12, 'delivered_at'=>'2024-02-28', 'next_delivery_at'=>'2024-03-28', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>13, 'supplier_id'=>3, 'product_id'=>13, 'delivered_at'=>'2024-03-19', 'next_delivery_at'=>'2024-04-19', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>14, 'supplier_id'=>2, 'product_id'=>14, 'delivered_at'=>'2024-03-23', 'next_delivery_at'=>'2024-04-23', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>15, 'supplier_id'=>2, 'product_id'=>15, 'delivered_at'=>'2024-02-02', 'next_delivery_at'=>'2024-03-02', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>16, 'supplier_id'=>1, 'product_id'=>16, 'delivered_at'=>'2024-02-16', 'next_delivery_at'=>'2024-03-16', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>17, 'supplier_id'=>1, 'product_id'=>17, 'delivered_at'=>'2024-03-25', 'next_delivery_at'=>'2024-04-25', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>18, 'supplier_id'=>1, 'product_id'=>18, 'delivered_at'=>'2024-03-13', 'next_delivery_at'=>'2024-04-13', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>19, 'supplier_id'=>1, 'product_id'=>19, 'delivered_at'=>'2024-03-23', 'next_delivery_at'=>'2024-04-23', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>20, 'supplier_id'=>4, 'product_id'=>20, 'delivered_at'=>'2024-02-21', 'next_delivery_at'=>'2024-03-21', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>21, 'supplier_id'=>2, 'product_id'=>21, 'delivered_at'=>'2024-03-31', 'next_delivery_at'=>'2024-04-30', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>22, 'supplier_id'=>1, 'product_id'=>22, 'delivered_at'=>'2024-03-27', 'next_delivery_at'=>'2024-04-27', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>23, 'supplier_id'=>3, 'product_id'=>23, 'delivered_at'=>'2024-04-11', 'next_delivery_at'=>'2024-04-18', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>24, 'supplier_id'=>3, 'product_id'=>24, 'delivered_at'=>'2024-04-07', 'next_delivery_at'=>'2024-04-14', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>25, 'supplier_id'=>1, 'product_id'=>25, 'delivered_at'=>'2024-05-07', 'next_delivery_at'=>'2024-05-14', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>26, 'supplier_id'=>2, 'product_id'=>26, 'delivered_at'=>'2024-05-05', 'next_delivery_at'=>'2024-05-12', 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
