<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('persons')->insert([
            ['id'=>1,  'family_id'=>null, 'first_name'=>'Hans',    'insertion'=>'van',    'last_name'=>'Leeuwen',      'birth_date'=>'1958-02-12', 'person_type'=>'Manager',     'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>2,  'family_id'=>null, 'first_name'=>'Jan',     'insertion'=>'van der','last_name'=>'Sluijs',       'birth_date'=>'1993-04-30', 'person_type'=>'Medewerker',  'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>3,  'family_id'=>null, 'first_name'=>'Herman',  'insertion'=>'den',    'last_name'=>'Duiker',       'birth_date'=>'1989-08-30', 'person_type'=>'Vrijwilliger','is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>4,  'family_id'=>1,    'first_name'=>'Johan',   'insertion'=>'van',    'last_name'=>'Zevenhuizen',  'birth_date'=>'1990-05-20', 'person_type'=>'Klant',       'is_representative'=>true,  'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>5,  'family_id'=>1,    'first_name'=>'Sarah',   'insertion'=>'den',    'last_name'=>'Dolder',       'birth_date'=>'1985-03-23', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>6,  'family_id'=>1,    'first_name'=>'Theo',    'insertion'=>'van',    'last_name'=>'Zevenhuizen',  'birth_date'=>'2015-03-08', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>7,  'family_id'=>1,    'first_name'=>'Jantien', 'insertion'=>'van',    'last_name'=>'Zevenhuizen',  'birth_date'=>'2016-09-20', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>8,  'family_id'=>2,    'first_name'=>'Arjan',   'insertion'=>null,     'last_name'=>'Bergkamp',     'birth_date'=>'1968-07-12', 'person_type'=>'Klant',       'is_representative'=>true,  'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>9,  'family_id'=>2,    'first_name'=>'Janneke', 'insertion'=>null,     'last_name'=>'Sanders',      'birth_date'=>'1969-05-11', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>10, 'family_id'=>2,    'first_name'=>'Stein',   'insertion'=>null,     'last_name'=>'Bergkamp',     'birth_date'=>'2009-02-02', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>11, 'family_id'=>2,    'first_name'=>'Judith',  'insertion'=>null,     'last_name'=>'Bergkamp',     'birth_date'=>'2022-02-05', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>12, 'family_id'=>3,    'first_name'=>'Mazin',   'insertion'=>'van',    'last_name'=>'Vliet',        'birth_date'=>'1968-08-18', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>13, 'family_id'=>3,    'first_name'=>'Selma',   'insertion'=>'van',    'last_name'=>'Vliet',        'birth_date'=>'1965-09-04', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>14, 'family_id'=>4,    'first_name'=>'Eva',     'insertion'=>null,     'last_name'=>'Scherder',     'birth_date'=>'2000-04-07', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>15, 'family_id'=>4,    'first_name'=>'Felicia', 'insertion'=>null,     'last_name'=>'Scherder',     'birth_date'=>'2021-11-29', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>16, 'family_id'=>4,    'first_name'=>'Devin',   'insertion'=>null,     'last_name'=>'Scherder',     'birth_date'=>'2024-03-01', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>17, 'family_id'=>5,    'first_name'=>'Frieda',  'insertion'=>'de',     'last_name'=>'Jong',         'birth_date'=>'1980-09-04', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>18, 'family_id'=>5,    'first_name'=>'Simeon',  'insertion'=>'de',     'last_name'=>'Jong',         'birth_date'=>'2018-05-23', 'person_type'=>'Klant',       'is_representative'=>false, 'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=>19, 'family_id'=>6,    'first_name'=>'Hanna',   'insertion'=>'van der','last_name'=>'Berg',         'birth_date'=>'1999-09-09', 'person_type'=>'Klant',       'is_representative'=>true,  'is_active'=>true, 'note'=>null, 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
