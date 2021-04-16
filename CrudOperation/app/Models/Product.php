<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
       	'fname',
       	'lname',
       	'email',
       	'phone',
       	'hobbies',
       	'image',	
       	'country_id',
       	'state_id',
       	'city_id',
       	'created_at',
       	'updated_at'
    ];
}
