<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerHobbie extends Model
{
    use HasFactory;

    protected $table = 'customers_hobbies';

    protected $fillable = [
        'customer_id',
        'hobbie_id'
    ];
}
