<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function branch(){
        return $this->belongsTo(PackageBranch::class, 'package_branch_id');
    }

    public function category(){
        return $this->belongsTo(PackageCategory::class, 'package_category_id','id');
    }

    public function type(){
        return $this->belongsTo(PackageType::class, 'package_type_id');
    }
}
