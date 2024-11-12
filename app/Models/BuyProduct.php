<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyProduct extends Model
{
    protected $fillable = [
        "user_id","category_id", "product_cost", "qty", "invoice_url", "unit", "rate", "payment", "due"
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
