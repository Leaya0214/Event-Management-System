<?php

namespace App\Models\BackEnd;

use App\Models\BackEnd\Expensecategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Expensecategory::class,'category_id','id');
    }
    public function event(){
        return $this->belongsTo(EventDetails::class,'event_id','id');
    }
}
