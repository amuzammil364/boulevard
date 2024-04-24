<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'role',
        'name',
        'address',
        'cnic',
        'salary',
        'comps',
        'status',
        'start_date',
    ];

}
