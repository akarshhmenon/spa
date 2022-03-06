<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BookedItem extends Model
{
    use HasFactory, SoftDeletes;

    public function product_and_service()
    {
        return $this->belongsTo(ProductAndService::class, 'product_service_id', 'id');
    }
    
}
