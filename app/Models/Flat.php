<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    protected $table = 'flats';

    protected $fillable = [
        'flat_number',
        'phase_number',
        'occupancy',
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class , "flat_id" , "id");
    }

    public function payments()
    {
        return $this->hasMany(Payment::class , "flat_id" , "id");
    }




}


