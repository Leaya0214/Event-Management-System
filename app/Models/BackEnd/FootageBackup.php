<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootageBackup extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'footage_backup';
}
