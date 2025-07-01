<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('warehouses')->insert([
            ['id'=>1, 'received_date'=>'2024-05-12', 'delivery_date'=>null, 'package_unit'=>'5 kg', 'quantity'=>20, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>2, 'received_date'=>'2024-05-26', 'delivery_date'=>null, 'package_unit'=>'2.5 kg', 'quantity'=>40, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>3, 'received_date'=>'2024-04-22', 'delivery_date'=>null, 'package_unit'=>'1 kg', 'quantity'=>30, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>4, 'received_date'=>'2024-05-16', 'delivery_date'=>null, 'package_unit'=>'1.5 kg', 'quantity'=>25, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>5, 'received_date'=>'2024-05-23', 'delivery_date'=>null, 'package_unit'=>'4 stuks', 'quantity'=>75, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>6, 'received_date'=>'2024-05-23', 'delivery_date'=>null, 'package_unit'=>'1 kg/tros', 'quantity'=>60, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>7, 'received_date'=>'2024-03-19', 'delivery_date'=>null, 'package_unit'=>'2 kg/tros', 'quantity'=>200, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>8, 'received_date'=>'2024-06-19', 'delivery_date'=>null, 'package_unit'=>'200 g', 'quantity'=>45, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>9, 'received_date'=>'2024-07-23', 'delivery_date'=>null, 'package_unit'=>'100 g', 'quantity'=>60, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>10, 'received_date'=>'2024-07-23', 'delivery_date'=>null, 'package_unit'=>'1 liter', 'quantity'=>120, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>11, 'received_date'=>'2024-06-02', 'delivery_date'=>null, 'package_unit'=>'250 g', 'quantity'=>80, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>12, 'received_date'=>'2024-01-04', 'delivery_date'=>null, 'package_unit'=>'6 stuks', 'quantity'=>120, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>13, 'received_date'=>'2024-04-07', 'delivery_date'=>null, 'package_unit'=>'800 g', 'quantity'=>220, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>14, 'received_date'=>'2024-04-15', 'delivery_date'=>null, 'package_unit'=>'1 stuk', 'quantity'=>130, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>15, 'received_date'=>'2024-04-28', 'delivery_date'=>null, 'package_unit'=>'150 ml', 'quantity'=>72, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>16, 'received_date'=>'2024-04-19', 'delivery_date'=>null, 'package_unit'=>'1 l', 'quantity'=>12, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>17, 'received_date'=>'2024-04-13', 'delivery_date'=>null, 'package_unit'=>'250 g', 'quantity'=>300, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>18, 'received_date'=>'2024-03-02', 'delivery_date'=>null, 'package_unit'=>'25 zakjes', 'quantity'=>280, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>19, 'received_date'=>'2024-04-16', 'delivery_date'=>null, 'package_unit'=>'500 g', 'quantity'=>330, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>20, 'received_date'=>'2024-04-25', 'delivery_date'=>null, 'package_unit'=>'1 kg', 'quantity'=>34, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>21, 'received_date'=>'2024-04-13', 'delivery_date'=>null, 'package_unit'=>'50 g', 'quantity'=>23, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>22, 'received_date'=>'2024-04-23', 'delivery_date'=>null, 'package_unit'=>'1 l', 'quantity'=>46, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>23, 'received_date'=>'2024-04-21', 'delivery_date'=>null, 'package_unit'=>'250 ml', 'quantity'=>98, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>24, 'received_date'=>'2024-04-30', 'delivery_date'=>null, 'package_unit'=>'1 potje', 'quantity'=>56, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>25, 'received_date'=>'2024-04-01', 'delivery_date'=>null, 'package_unit'=>'1 l', 'quantity'=>210, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>26, 'received_date'=>'2024-04-01', 'delivery_date'=>null, 'package_unit'=>'4 stuks', 'quantity'=>24, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>27, 'received_date'=>'2024-04-07', 'delivery_date'=>null, 'package_unit'=>'300 g', 'quantity'=>87, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>28, 'received_date'=>'2024-04-22', 'delivery_date'=>null, 'package_unit'=>'200 g', 'quantity'=>230, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>29, 'received_date'=>'2024-04-21', 'delivery_date'=>null, 'package_unit'=>'80 g', 'quantity'=>30, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
