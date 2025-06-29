<?php

namespace App\Models\BackEnd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventDetailsLog extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'event_details_pivot';

    public function user(){
        return $this->belongsTo(User::class,'assigned_user_id','id');
    }
    public function eventDetail(){
        return $this->belongsTo(EventDetails::class, 'event_details_id');
    }
}
