<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobcardPayment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function jobcard()
	{
		return $this->belongsTo(Jobcard::class,'id','jobcard_id')->withTrashed();
	}
}
