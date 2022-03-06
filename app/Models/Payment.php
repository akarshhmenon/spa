<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function customer(){

        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function bookedItem(){

        return $this->belongsTo(BookedItem::class, 'booking_id', 'booking_id');
    }



}
