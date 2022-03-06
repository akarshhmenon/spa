<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Booking extends Model
{
    use HasFactory, SoftDeletes;
    public function service()
    {
        return $this->belongsTo(ProductAndService::class, 'service_id', 'id');
    }

 
    public function booked_items()
    {
        return $this->hasMany(BookedItem::class, 'booking_id', 'id');
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    
    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, 'employee_id', 'id');
    // }




}
