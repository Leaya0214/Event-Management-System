<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBranch extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'package_branch';
}
