<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentlog extends Model
{
    use HasFactory;

    protected $guarded = [];
    
     public function payment(){
        return $this->belongsTo(PayMentModel::class,'payment_id');

    }
}
