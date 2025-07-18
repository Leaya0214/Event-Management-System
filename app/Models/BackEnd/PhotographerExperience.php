<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class PhotographerExperience extends Model
{
    use HasFactory;
     protected $guarded = [];

    protected $table = 'photographer_experiences';
    
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
