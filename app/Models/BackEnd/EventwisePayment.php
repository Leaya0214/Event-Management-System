<?php

namespace App\Models\BackEnd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventwisePayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'event_wise_payments';
    
    public function event_details(){
        return $this->belongsTo(EventDetails::class,'event_details_id');  
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
