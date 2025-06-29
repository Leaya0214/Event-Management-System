<?php

namespace App\Models\BackEnd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffPaymentlog extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'staff_payment_logs';
    
}
