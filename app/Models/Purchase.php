<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;


    public function vendors(){

        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
