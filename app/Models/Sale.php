<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function customer(){

        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function sale_items(){
        return $this->hasMany(SaleItem::class, 'sale_id', 'id');
    }


}
