<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'event_types';
    protected $primaryKey = 'type_id';
}
