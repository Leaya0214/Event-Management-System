<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerExperience extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function artist(){
        return $this->belongsTo(User::class, 'artist_id','id');
    }
}
