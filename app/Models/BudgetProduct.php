<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetProduct extends Model
{
    use HasFactory;

    protected $table = 'budget_product';

    protected $fillable = [
        'budget_id',
        'product_id',
        'unitary',
        'unit_price',
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_ad',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
