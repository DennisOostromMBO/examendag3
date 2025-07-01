<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllergyPersonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('allergy_person')->insert([
            ['id'=>1,  'person_id'=>4,  'allergy_id'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>2,  'person_id'=>5,  'allergy_id'=>2, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>3,  'person_id'=>6,  'allergy_id'=>3, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>4,  'person_id'=>7,  'allergy_id'=>4, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>5,  'person_id'=>8,  'allergy_id'=>3, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>6,  'person_id'=>9,  'allergy_id'=>2, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>7,  'person_id'=>10, 'allergy_id'=>5, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>8,  'person_id'=>12, 'allergy_id'=>2, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>9,  'person_id'=>13, 'allergy_id'=>4, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>10, 'person_id'=>14, 'allergy_id'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>11, 'person_id'=>15, 'allergy_id'=>3, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>12, 'person_id'=>16, 'allergy_id'=>5, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>13, 'person_id'=>17, 'allergy_id'=>1, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>14, 'person_id'=>17, 'allergy_id'=>2, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>15, 'person_id'=>18, 'allergy_id'=>4, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>16, 'person_id'=>19, 'allergy_id'=>4, 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
