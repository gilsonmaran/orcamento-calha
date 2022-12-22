<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'customer_id',
        'labor',
        'amount',
        'comments',
        'add_amount'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];


    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
