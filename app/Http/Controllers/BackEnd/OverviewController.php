<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\BackEnd\Overview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class OverviewController extends Controller
{
    public function index()
    {
        if (!check_access("staticContent.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $contents = Overview::all();
        return view('BackEnd.webcontent.overview.overview',compact('contents'));
    }

    
    public function addOverview()
    {
        if (!check_access("staticContent.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.webcontent.overview.addOverview');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->hasFile('image')){ 
            $image = $request->file('image'); 
            $imageEncName = rand(0,9999).md5($image->getClientOriginalName()); 
            $imageExtension = $image->getClientOriginalExtension(); 
            $image_overview = $imageEncName.".".$imageExtension; 
            $destinationPath = "backend/content";
            $image->move($destinationPath, $image_overview); 
        }else{ 
            $image_overview="";
        } 
       
        Overview::create([
            'type' => $request['type'],
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $image_overview,
            'status' =>1
           
        ]);

        Toastr::success("New Content Added !");

        return redirect()->route('content');
    }

  
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        if (!check_access("staticContent.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $content = Overview::findOrfail($id);
        // dd(request()->is('blog','blog/*'));
        return view('BackEnd.webcontent.overview.editOverview',compact('content'));
    }


    
    public function update(Request $request, $id)
    {
        $content = Overview::findOrfail($id);
        $overview = $content->image;

        $validator = Validator::make($request->all(),[
            'description' => 'required',
            // 'image' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){ 
            
            $path = public_path() . "backend/content/" . $content->image; 
            if (file_exists($path)) { 
                unlink($path); 
            } 
            $image = $request->file('image'); 
            $imageEncName = rand(0,9999).md5($image->getClientOriginalName()); 
            $imageExtension = $image->getClientOriginalExtension(); 
            $overview = $imageEncName.".".$imageExtension; 
            $destinationPath = "backend/content/";
            $image->move($destinationPath, $overview); 
        }

        $content->update([
            'type' => $request['type'],
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $overview,
        ]);

        Toastr::success("Updated Successfully !!");

        return redirect()->route('content')->with('message','Data Updated Successfully!');
    }

    public function statusUpdate($id){
        try{
            if (!check_access("staticContent.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = Overview::find($id);
            if($status->status == 1){
                $status->status = 0;
                Toastr::warning("Status Inactive !");
            }
            else{
                $status->status = 1;
                Toastr::success("Status Activated !");
            }
            $status->save();

            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }
    
    public function destroy($id)
    {
        if (!check_access("staticContent.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $content = Overview::find($id);
        $content -> delete();
        return response()->json(['message'=>'Deleted Successfully!']);
    }
}
