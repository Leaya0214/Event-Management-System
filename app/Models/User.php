<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'image',
        'address',
        'designation',
        'details',
        'password',
        'type',
        'alternate_number',
        'category',
        'experience_level',
        'status',
        'position',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public static function getPermissionGroups() {
        $permissionGroup = Permission::select('group_name as name',\DB::raw('MIN(id) as min_id'))
            ->groupBy('group_name')
            ->orderBy('min_id')
            ->get();
        return $permissionGroup;
    }

    public static function getPermissionByGroupName($group_name) {
        $permissions = Permission::where('group_name', $group_name)
            ->get();
        return $permissions;
    }

   public static function roleHasPermissions($role, $permissions) {
    $hasPermission = true;
    foreach ($permissions as $permission) {
        if (!$role->hasPermissionTo($permission)) {
            $hasPermission = false;
            return $hasPermission;
        }
    }

    return $hasPermission;
}

    public function scopeActive($query) {
        return $query->where('status', 1);
    }
}
