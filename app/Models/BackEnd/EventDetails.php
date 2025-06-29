<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetails extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function shift(){
        return $this->belongsTo(EventShift::class,'shift_id');
    }
    public function type(){
        return $this->belongsTo(EventType::class,'type_id');
    }
    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
    public function category(){
        return $this->belongsTo(PackageCategory::class,'category_id');
    }
    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }
    public function event(){
        return $this->belongsTo(EventMaster::class,'master_id');
    }
}
