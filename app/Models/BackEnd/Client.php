<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;   


class Client extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'clients';
}
