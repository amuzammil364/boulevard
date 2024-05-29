<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'flat_id',
        'type',
        'status',
        'payment_id',
        'payment_month',
        'amount',
        'mode_of_payment',
        'due_date',
        'paid_date',
    ];

    public function flat(): BelongsTo
    {
        return $this->belongsTo(Flat::class);
    }
}
