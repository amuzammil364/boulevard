<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';

    protected $fillable = [
        'employee_id',
        'type',
        'status',
        'payment_id',
        'amount',
        'mode_of_payment',
        'expense_month',
        'receipt_id',
        'due_date',
        'paid_date',
    ];

    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

}
