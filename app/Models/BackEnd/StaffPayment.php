<?php

namespace App\Models\BackEnd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'staff_payments';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function created_user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
   
}
