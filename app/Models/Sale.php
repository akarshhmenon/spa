<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sale extends Model
{
    use HasFactory, SoftDeletes;
    public function customer(){

        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withTrashed();
    }

    public function sale_items(){
        return $this->hasMany(SaleItem::class, 'sale_id', 'id');
    }


}
