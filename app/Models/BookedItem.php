<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedItem extends Model
{
    use HasFactory;

    public function product_and_service()
    {
        return $this->belongsTo(ProductAndService::class, 'product_service_id', 'id');
    }
    
}
