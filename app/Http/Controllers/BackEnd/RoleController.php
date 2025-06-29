<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index(){
        if (!check_access('role.list')) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $roles = Role::get();

        return view('BackEnd.user&role.role.managerole',compact('roles'));
    }

    public function storeRole(Request $request){
        try {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                Toastr::error("Invalid Data given!");
                return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
            }
            Role::create(['name' => $request->input('name')]);
            Toastr::success("Role created!");
            return redirect()->route('role');
        } catch (\Exception $exception) {
            Toastr::error($exception->getMessage());
            return redirect()->back();
        }

    }
    public function editRole($id)
    {
        if (!check_access("role.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $role = Role::findById($id);
        $permissions_groups = User::getPermissionGroups();
        $permissions = Permission::all();
        return view('BackEnd.user&role.role.editRole', compact('role','permissions','permissions_groups'));
    }
    public function updateRole(Request $request, $id){
        try {
            if (!check_access("role.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $validator = Validator::make($request->all(),[
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                Toastr::error("Invalid Data given!");
                return redirect()->back()->withErrors($validator->getMessageBag())->withInput();
            }
            $role = Role::findById($id);
            $permissions = [];
           
            if ($request->input('permissions')) {
                $permissions = $request->input('permissions');
              
            }
            $role->update(['name' => $request->input('name')]);

            $roles = $role->permissions;
            // dd($roles);
            foreach ($roles as $key => $item) {
                if ($item && !empty($permissions)) {
                    $role->revokePermissionTo($item->id);
                }
            }

            foreach ($permissions as $key => $permission) {
                $role->givePermissionTo($permission);
            }
            Toastr::success("Role Updated!");
            return redirect()->back();
        } catch (\Exception $exception) {
            Toastr::error($exception->getMessage());
            return redirect()->route('role');
        }
    }
    public function deleteRole($id){
        if (!check_access("role.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $item = Role::findById($id);
        $item->delete();
        Toastr::success("Role Deleted!");
        return redirect()->back();
    }

}

