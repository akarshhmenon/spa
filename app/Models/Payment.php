<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payment extends Model
{
    use HasFactory, SoftDeletes;

    public function customer(){

        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withTrashed();
    }

    public function bookedItem(){

        return $this->belongsTo(BookedItem::class, 'booking_id', 'booking_id');
    }



}
