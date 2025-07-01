<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AllergySeeder::class,
            CategorySeeder::class,
            RoleSeeder::class,
            ContactSeeder::class,
            FoodwishSeeder::class,
            FamilySeeder::class,
            SupplierSeeder::class,
            WarehouseSeeder::class,
            ProductSeeder::class,
            PersonSeeder::class,
            ContactFamilySeeder::class,
            ContactSupplierSeeder::class,
            FoodwishFamilySeeder::class,
            FoodparcelSeeder::class,
            ProductWarehouseSeeder::class,
            ProductFoodparcelSeeder::class,
            UserSeeder::class,
            RoleUserSeeder::class,
            AllergyPersonSeeder::class,
            ProductSupplierSeeder::class,
        ]);
    }
}