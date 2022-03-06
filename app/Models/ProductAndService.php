<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAndService extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function category(){

        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function images(){

        return $this->hasMany(Image::class, 'item_id', 'id');
    }



}
