<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMaster extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

   public function details()
    {
        return $this->hasMany(EventDetails::class,'master_id');
    }
    
    public function payment()
    {
        return $this->hasOne(PayMentModel::class,'event_id');
    }
}
