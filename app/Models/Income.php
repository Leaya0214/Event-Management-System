<?php

namespace App\Models;

use App\Models\BackEnd\Expensecategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Expensecategory::class,'category_id','id');
    }
}
