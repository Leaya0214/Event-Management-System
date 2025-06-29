<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\BackEnd\TeamMember;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TeamMemberController extends Controller
{
    public function index(){
        if (!check_access("teamMember.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $members = TeamMember::all();
        return view('BackEnd.webcontent.team_member.index',compact('members'));
    }

    public function createMember(){
        if (!check_access("teamMember.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.webcontent.team_member.create');

    }

    public function storeMember(Request $request){
        try{

        $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:255'],
            'designation' => 'required',
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
            $destination_path = "backend/team_member/"; 
            $file->move($destination_path,$image_name); 
        }else{ 
            $image_name=""; 
        }

        $input = [
            'name'   => $request->input('name'),
            'image'   => $image_name,
            'designation'   => $request->input('designation'),
            'details'   => $request->details,
        ];

        TeamMember::create($input);

        Toastr::success("Member Created Successfully!");

        return redirect()->route('member');

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function editMember($id){
        if (!check_access("teamMember.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $user= TeamMember::where('id',$id)->first();
        return view('BackEnd.webcontent.team_member.edit',compact('user'));
        
    }

    public function updateMember(Request $request, $id){
        try{
            $user = TeamMember::find($id);

            $image_name = $user->image;

            $rules = [
                'name' => ['required','string','max:255'],
                'designation' => 'required',
            ];

            
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                Toastr::error("Invalid Data given!");
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if($request->hasFile('image')){ 
                $path = public_path() . "backend/team_member/" . $user->image;
                if (file_exists($path)) { 
                    unlink($path); 
                }
                $file = $request->file('image'); 
                $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
                $image_extension = $file->getClientOriginalExtension(); 
                $image_name = $image_enc_name.".".$image_extension; 
                $destination_path = "backend/team_member/"; 
                $file->move($destination_path,$image_name); 
            }


            $input = [
                'name'   => $request->input('name'),
                'image'   => $image_name,
                'designation'   => $request->input('designation'),
                'details'   => $request->details,
            ];
    
            // dd($input);

            $user->update($input);

            Toastr::success("Data Updated Successfully!");
    
            return redirect()->route('member');

        }catch(\Exception $e){
            return $e->getMessage();

        }
    }
    public function deleteUser($id){
        try{
            if (!check_access("teamMember.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $user = TeamMember::find($id);
            $user -> delete();
            return redirect()->route('member')->with('message','Deleted Succesfully!');
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function statusUpdate($id){
        try{
            if (!check_access("teamMember.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $user = TeamMember::find($id);
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

    public function delete($id){
        try{
            if (!check_access("teamMember.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $systemData = TeamMember::find($id);
            $systemData -> delete();
            Toastr::success("Deleted Successfully!");
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
