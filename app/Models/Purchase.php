<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    public function vendors(){

        return $this->belongsTo(Vendor::class, 'vendor_id', 'id')->withTrashed();
    }

    public function purchase_items(){
        return $this->hasMany(Purchase_item::class, 'purchase_id', 'id');
    }
}
