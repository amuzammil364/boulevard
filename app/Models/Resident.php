<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resident extends Model
{
    use HasFactory;


    protected $table = 'residents';

    protected $fillable = [
        'flat_id',
        'type',
        'status',
        'full_name',
        'email',
        'mobile',
        'intercom',
        'cnic',
        'in_date',
        'out_date',
    ];

    public function flat() : BelongsTo
    {
        return $this->belongsTo(Flat::class);
    }



}
