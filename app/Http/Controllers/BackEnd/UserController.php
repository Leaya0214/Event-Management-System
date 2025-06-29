<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function index(){
        if (!check_access("user.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
          }
        return view('BackEnd.user&role.user.manage_user');
    }


    public function allUser(){
        if (!check_access("user.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
          }
        $users = User::orderBy('id','desc')->get();
        // dd($users);

        return DataTables::of($users)
        ->addIndexColumn()
        ->setRowId(function($user){return $user->id;})
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('name',function($user){
            $name = $user->name;
            return $name;
        })
        ->addColumn('email',function($user){
            $email = $user->email;
            return $email;
        })
        ->addColumn('designation',function($user){
            $designation = $user->designation;
            return $designation;
        })
        ->addColumn('role',function($user){
            $role = $user->type;
            return $role;
        })
        ->addColumn('address',function($user){
            $address = $user->address;
            return $address;
        })
       ->addColumn('action', function ($user) {
           
            $status   = '';
            $edit     = '';
            $delete   = '';
            if (check_access("user.edit")) {
                if($user->status == 1){
                    $status = '<a href="'.route("user.status", $user->id) .'" class="btn" title="Click to Deactive class" style="padding: 2px;"> 
                                    <i class="fa fa-arrow-up text-success actions_icon"></i>
                                </a> ';
                }else{
                    $status = '<a href="'.route("user.status", $user->id) .'" class="btn" title="Click to active class" style="padding: 2px;"> 
                                    <i class="fa fa-arrow-down text-danger actions_icon "></i>
                                </a>';
                }

                $edit = '<a href="'.route("user.editUser", $user->id) .'" class="" style="color:#042778;">
                        <i class="fas fa-edit"></i></a>';
            }
            if (check_access("user.delete")) {

                $delete = " <a href='" . route("user.delete", $user->id) . "' class='btn' style='color:#d55565;' onclick=" . '"' . "return confirm('Are you sure you want to delete?');" . '"' . "><i class='fa fa-trash'></i></a>";
            }
            return $status . $edit . $delete ;
        })
      ->rawColumns(['address','email','action','name'])
      ->make(true);
    }


    public function createUser(){
        if (!check_access("user.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.user&role.user.create_user');

    }

    public function storeUser(Request $request){

        try{

        $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:255'],
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'min:5'],
            'phone' =>'required',
            'address' =>'required',
        ]);

        if($validator->fails()){
            Toastr::error("Invalid Data given!");
            // dd($toastr);
         return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){ 
            $file = $request->file('image'); 
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $image_name = $image_enc_name.".".$image_extension; 
            $destination_path = "backend/user/"; 
            $file->move($destination_path,$image_name); 
        }else{ 
            $image_name=""; 
        }

        $position = $request->input('position');

        $allPosition = json_encode($position);

        $input = [
            'name'   => $request->input('name'),
            'email'   => $request->input('email'),
            'phone'   => $request->input('phone'),
            'alternate_number'   => $request->input('alternate_number'),
            'image'   => $image_name,
            'address'   => $request->input('address'),
            'type'      => $request->input('type'),
            'password'   => Hash::make($request->input('password')),
            'designation'   => $request->input('designation'),
            'category'   => $request->input('category'),
            'experience_level'   => $request->experience_level,
            'position'   => $allPosition,
            'details'   => $request->details,
            'user_role'   => $request->user_role,
        ];

        User::create($input);

        Toastr::success("User Created!");

        return redirect()->route('user');

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }


    public function editUser($id){
        if (!check_access("user.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $user= User::where('id',$id)->first();
        $positions = json_decode($user->position);
        return view('BackEnd.user&role.user.edit_user',compact('user','positions'));
        
    }

    public function updateUser(Request $request, $id){
        try{
            // dd($id);

            $user = User::find($id);

            $image_name = $user->image;

            $rules = [
                'name' => ['required','string','max:255'],
                'phone' =>'required',
                'address' =>'required',
            ];

            
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                Toastr::error("Invalid Data given!");
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if($request->hasFile('image')){ 
                $path = public_path() . "backend/user/" . $user->image;
                if (file_exists($path)) { 
                    unlink($path); 
                }
                $file = $request->file('image'); 
                $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
                $image_extension = $file->getClientOriginalExtension(); 
                $image_name = $image_enc_name.".".$image_extension; 
                $destination_path = "backend/user/"; 
                $file->move($destination_path,$image_name); 
            }

            $position = $request->input('position');

            $allPosition = json_encode($position);


            $input = [
                'name'   => $request->input('name'),
                'email'   => $request->input('email'),
                'phone'   => $request->input('phone'),
                'alternate_number'   => $request->input('alternate_number'),
                'image'   => $image_name,
                'address'   => $request->input('address'),
                'type'      => $request->input('type'),
                'password'   => Hash::make($request->input('password')),
                'designation'   => $request->input('designation'),
                'category'   => $request->input('category'),
                'experience_level'   => $request['experience_level'],
                'position'   =>  $allPosition,
                'details'   => $request['details'],
                'user_role'   => $request['user_role'],
            ];
            // dd($input);
            $user->update($input);

            Toastr::success("Data Updated Successfully!");
    
            return redirect()->route('user');

        }catch(\Exception $e){
            return $e->getMessage();

        }
    }
    public function deleteUser($id){
        try{
            if (!check_access("user.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $user = User::find($id);
            $user -> delete();
            return redirect()->route('user')->with('message','Deleted Succesfully!');
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function statusUpdate($id){
        try{
            if (!check_access("user.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $user = User::find($id);
            if($user->status == 1){
                $user->status = 0;
            }
            else{
                $user->status = 1;
            }
            $user->save();
            Toastr::success("Status Updated Successfully!");
            return redirect()->back()->with('message','Status updated Successfully!');
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}

