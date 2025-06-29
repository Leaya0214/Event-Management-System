<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermisssionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         /*
        TRUNCATE role_has_permissions;
        TRUNCATE model_has_roles;
        TRUNCATE model_has_permissions;
        TRUNCATE roles;
        TRUNCATE permissions;
         */
        Schema::disableForeignKeyConstraints();
        \DB::table('role_has_permissions')->truncate();
        \DB::table('model_has_roles')->truncate();
        \DB::table('model_has_permissions')->truncate();
        \DB::table('roles')->truncate();
        \DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        // Create Role
        $roleSuperAdmin = Role::create([
            'name'       => 'Super Admin',
        ]);

// $roleUser       = Role::create(['name' => 'user', 'guard_name' => 'admin']);

        // Permission List In Array
        $permissions = [
            // Dashboard
            [
                'group_name'  => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                ],
            ],
            // Application
            [
                'group_name'  => 'system setting',
                'permissions' => [
                    'systemSetting.view',
                    'systemSetting.edit',
                ],
            ],
            // Slider
            [
                'group_name'  => 'slider',
                'permissions' => [
                    'slider.list',
                    'slider.create',
                    'slider.edit',
                    'slider.delete',
                ],
            ],
            // Category
            [
                'group_name'  => 'service',
                'permissions' => [
                    'service.list',
                    'service.create',
                    'service.edit',
                    'service.delete',
                ],
            ],
            // Sub Category
            [
                'group_name'  => 'blog',
                'permissions' => [
                    'blog.list',
                    'blog.create',
                    'blog.edit',
                    'blog.delete',
                ],
            ],

            // Team Member
            [
                'group_name'  => 'team member',
                'permissions' => [
                    'teamMember.list',
                    'teamMember.create',
                    'teamMember.edit',
                    'teamMember.delete',
                ],
            ],

            // Client Reviews
            [
                'group_name'  => 'client review',
                'permissions' => [
                    'clientReview.list',
                    'clientReview.create',
                    'clientReview.edit',
                    'clientReview.delete',
                ],
            ],

            // Static Content
            [
                'group_name'  => 'static content',
                'permissions' => [
                    'staticContent.list',
                    'staticContent.create',
                    'staticContent.edit',
                    'staticContent.delete',
                ],
            ],

            // Filter Category
            [
                'group_name'  => 'portfolio',
                'permissions' => [
                    'portfolio.list',
                    'portfolio.create',
                    'portfolio.edit',
                    'portfolio.delete',
                ],
            ],

            //Branch
            [
                'group_name'  => 'branch',
                'permissions' => [
                    'branch.list',
                    'branch.create',
                    'branch.edit',
                    'branch.delete',
                ],
            ],

            //District
            [
                'group_name'  => 'district',
                'permissions' => [
                    'district.list',
                    'district.create',
                    'district.edit',
                    'district.delete',
                ],
            ],

            // Package
            [
                'group_name'  => 'package category',
                'permissions' => [
                    'category.list',
                    'category.create',
                    'category.edit',
                    'category.delete',
                ],
            ],

            [
                'group_name'  => 'package type',
                'permissions' => [
                    'packageType.list',
                    'packageType.create',
                    'packageType.edit',
                    'packageType.delete',
                ],
            ],

            [
                'group_name'  => 'package',
                'permissions' => [
                    'package.list',
                    'package.create',
                    'package.edit',
                    'package.delete',
                ],
            ],

            //Event

            [
                'group_name'  => 'event shift',
                'permissions' => [
                    'shift.list',
                    'shift.create',
                    'shift.edit',
                    'shift.delete',
                ],
            ],
            [
                'group_name'  => 'event type',
                'permissions' => [
                    'eventType.list',
                    'eventType.create',
                    'eventType.edit',
                    'eventType.delete',
                ],
            ],
            [
                'group_name'  => 'Event',
                'permissions' => [
                    'event.list',
                    'event.create',
                    'event.view',
                    'event.edit',
                    'event.status',
                    'event.delete',
                    'event.filter.form',
                    'event.filter.list',
                    'assign.photographer.other',
                    'assignevent.list',
                    'assignevent.edit',
                    'assign.user.delete',

                ],
            ],

            //stuffpanel event
            
            [
                'group_name'  => 'stuffevent',
                'permissions' => [
                    'stuffEvent.list',
                    'stuffEvent.view',
                ],
            ],
            // User
            [
                'group_name'  => 'user',
                'permissions' => [
                    'user.list',
                    'user.create',
                    'user.edit',
                    'user.delete',
                ],
            ],
            // Role
            [
                'group_name'  => 'role',
                'permissions' => [
                    'role.list',
                    'role.create',
                    'role.edit',
                    'role.delete',
                ],
            ],
            //Stuff

            [
                'group_name'  => 'stuff',
                'permissions' => [
                    'stuff.list',
                    'stuff.edit',
                ],
            ],
            [
                'group_name'  => 'clientInfo',
                'permissions' => [
                    'client.list',
                    'client.delete'
                ],
            ],
            
            [
                'group_name'  => 'AdminPanelPayment',
                'permissions' => [
                    'clientpayment.list',
                    'clientpayment.edit',
                    'stuffpayment.list',
                    'stuffpayment.edit',
                ],
            ],
            [
                'group_name'  => 'StaffPanelPayment',
                'permissions' => [
                    'payment.list',
                    'payment.view',
                ],
            ],

            [
                'group_name'  => 'cache clear',
                'permissions' => [
                    'cache.clear',
                ],
            ],
        
        ];

        // Assign Permission
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permission = Permission::create([
                    'guard_name' => 'web',
                    'name'       => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }

        }

        $admin          = User::where('type','super_admin')->first();
        $roleSuperAdmin = Role::find(1);
        $admin->assignRole($roleSuperAdmin);

    }
    
}
