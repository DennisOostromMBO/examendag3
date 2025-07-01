<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';

    protected $fillable = [
        'family_id',
        'first_name',
        'insertion',
        'last_name',
        'birth_date',
        'person_type',
        'is_representative',
        'is_active',
        'note',
    ];
}
