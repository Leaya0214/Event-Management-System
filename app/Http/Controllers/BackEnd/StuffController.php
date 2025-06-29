<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StuffController extends Controller
{
    public function index()
    {
        if (!check_access("stuff.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $users = User::orderBy('id', 'desc')->where('type', 'stuff')->orWhere('type', 'admin')->get();
//        dd($users);
        return view('BackEnd.user&role.stuffs.index', compact('users'));
    }

    public function edit($id)
    {
        if (!check_access("stuff.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $user = User::find($id);
        $roles = Role::all();
        return view('BackEnd.user&role.stuffs.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        try {
            if (!check_access("stuff.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $user = User::find($id);
            $roles = [];
            if ($request->input('role')) {
                $roles = $request->input('role');
            }
            // dd($user->roles);
            foreach ($user->roles as $item) {
                if (!key_exists($item->id, $roles)) {
                    $user->removeRole($item->id);
                }
            }
            foreach ($roles as $key => $role) {
                $role = Role::findById($key);
                $user->assignRole($role);
            }
            Toastr::success("Role assigned successfully!");
            return redirect()->route('stuff');
        } catch (\Exception $exception) {
            Toastr::error($exception->getMessage());
            return redirect()->back();
        }
    }
}
