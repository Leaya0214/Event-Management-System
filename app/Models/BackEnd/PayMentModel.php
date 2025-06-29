<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayMentModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payments';
    
    public function event_master()
    {
        return $this->belongsTo(EventMaster::class,'event_id');
    }
     public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }
}
