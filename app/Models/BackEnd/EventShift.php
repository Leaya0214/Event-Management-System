<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventShift extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'event_shifts';
    protected $primaryKey = 'shift_id';
}
