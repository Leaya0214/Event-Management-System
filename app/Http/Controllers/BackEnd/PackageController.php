<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BackEnd\Package;
use Yoeunes\Toastr\Facades\Toastr;
use App\Models\BackEnd\PackageType;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\PackageBranch;
use App\Models\BackEnd\PackageCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function index(){
        if (!check_access("packageType.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $types = PackageType::all();
        return view('BackEnd.package.package_type.index',compact('types'));
    }

   

    public function addPackage_type(){
        if (!check_access("packageType.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.package.package_type.create');
    }

    public function storePackage_type(Request $request){
        $validators = Validator::make($request->all(),[
            'package_type_name' => 'required'
        ]);
    
        if($validators->fails()){
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        $data = [
            'package_type_name' => $request['package_type_name'],
            'status' => 1
        ];

        PackageType::create($data);
        

        Toastr::success("Data Inserted Successfully!");
        return redirect()->route('package_type');

    }

    public function statusUpdate($id){
        try{
            if (!check_access("packageType.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = PackageType::find($id);
            // dd($status);
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

    public function edit($id)
    {
        if (!check_access("packageType.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $type_edit = PackageType::findOrfail($id);
        return view('BackEnd.package.package_type.edit',compact('type_edit'));
    }

    public function update(Request $request, $id)
    {
      try{
            $type_update = PackageType::findOrfail($id);

            $validator = Validator::make($request->all(),[
                'package_type_name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $type_update->update([
                'package_type_name' => $request['package_type_name'],
            ]);

            return redirect()->route('package_type')->with('message','Data Updated Successfully!');
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        if (!check_access("packageType.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $type_delete = PackageType::find($id);
        $type_delete -> delete();
        return redirect()->route('package_type')->with('message','Deleted Successfully!');
    }

    //Package Category

    public function package_category_index(){
        if (!check_access("category.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $categories = PackageCategory::all();
        return view('BackEnd.package.package_category.index',compact('categories'));
    }

    public function addPackage_category(){
        if (!check_access("category.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.package.package_category.create');
    }

    public function storePackage_category(Request $request){
        $validators = Validator::make($request->all(),[
            'category_name' => 'required'
        ]);
    
        if($validators->fails()){
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        $data = [
            'category_name' => $request['category_name'],
            'status' => 1
        ];

        PackageCategory::create($data);
        

        Toastr::success("Data Inserted Successfully!");
        return redirect()->route('package_category');

    }

    public function status_update($id){
        try{
            if (!check_access("category.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = PackageCategory::find($id);
            // dd($status);
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

    public function edit_category($id)
    {
        if (!check_access("category.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $category_edit = PackageCategory::findOrfail($id);
        return view('BackEnd.package.package_category.edit',compact('category_edit'));
    }

    public function update_category(Request $request, $id)
    {
        $category_update = PackageCategory::findOrfail($id);

        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category_update->update([
            'category_name' => $request['category_name'],
        ]);

        return redirect()->route('package_category')->with('message','Data Updated Successfully!');
    }

    public function destroy_category($id)
    {
        if (!check_access("category.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $category_delete = PackageCategory::find($id);
        $category_delete -> delete();
        return redirect()->route('package_category')->with('message','Deleted Successfully!');
    }


    //Package Branch

    public function package_branch_index(){
        if (!check_access("branch.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $branches = PackageBranch::all();
        return view('BackEnd.package.package_branch.index',compact('branches'));
    }

    public function addPackage_branch(){
        if (!check_access("branch.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.package.package_branch.create');
    }

    public function storePackage_branch(Request $request){
        $validators = Validator::make($request->all(),[
            'branch_name' => 'required',
            'address' => 'required'
        ]);
    
        if($validators->fails()){
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        if($request->hasFile('image')){ 
            $file = $request->file('image'); 
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $image_name = $image_enc_name.".".$image_extension; 
             
            $destination_path = "backend/branch/"; 
            $file->move($destination_path,$image_name); 
        }else{ 
            $image_name=""; 
        }

        $data = [
            'branch_name' => $request['branch_name'],
            'address' => $request['address'],
            'bg_image' => $request['image'],
            'status' => 1
        ];

        PackageBranch::create($data);
        

        Toastr::success("Data Inserted Successfully!");
        return redirect()->route('package_branch');

    }

    public function status_up($id){
        try{
            $status = PackageBranch::find($id);
            // dd($status);
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

    public function edit_branch($id)
    {
        if (!check_access("branch.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $branch_edit = PackageBranch::findOrfail($id);
        return view('BackEnd.package.package_branch.edit',compact('branch_edit'));
    }

    public function update_branch(Request $request, $id)
    {
        $branch_update = PackageBranch::findOrfail($id);

        $validator = Validator::make($request->all(),[
            'branch_name' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){ 
            $path = public_path() . "backend/branch/" . $branch_update->bg_image;
            if (file_exists($path)) { 
                unlink($path); 
            }
            $file = $request->file('image'); 
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $image_name = $image_enc_name.".".$image_extension; 
            $destination_path = "backend/branch/"; 
            $file->move($destination_path,$image_name); 
        }

        $branch_update->update([
            'branch_name' => $request['branch_name'],
            'bg_image' => $image_name,
            'address' => $request['address'],
        ]);

        return redirect()->route('package_branch')->with('message','Data Updated Successfully!');
    }

    public function destroy_branch($id){
        if (!check_access("branch.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $branch_delete = PackageBranch::find($id);
        $branch_delete -> delete();
        return redirect()->route('package_branch')->with('message','Deleted Successfully!');
    }

    //Package
    public function package_index(){
        if (!check_access("package.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $packages = Package::all();
        return view('BackEnd.package.package.index',compact('packages'));
    }

    public function getAllPackage(){
        if (!check_access("package.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $packages = Package::get();
        return DataTables::of($packages)
        ->addIndexColumn()
        ->setRowId(function($package){return $package->id;})
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('branch_name',function($package){
            $branch_name = $package->branch->branch_name;
            return $branch_name;
        })
        ->addColumn('package_type',function($package){
            $package_type = $package->type->package_type_name;
            return $package_type;
        })
        ->addColumn('category',function($package){
            $category = '';
            if($package->category){
             $category = $package->category->category_name;
            }
            return $category;
        })
        ->addColumn('name',function($package){
            $name = $package->name;
            return $name;
        })
        ->addColumn('position',function($package){
            $position = $package->position;
            return $position;
        })
        ->addColumn('amount',function($package){
            $amount = $package->discount;
            return $amount;
        })
        ->addColumn('short_details',function($package){
            $short_details = $package->short_details;
            return $short_details;
        })
        ->addColumn('status',function($package){
                    if($package->status == 1) {
                        $status = 
                            '<span
                            style="background-color: rgb(66, 134, 66); color:white; border-radius:5px;"
                            class="btn btn-xs btn-sm mr-1">Active</span>' ;
                        } else{
                            $status = 
                            '<span style="color:white; border-radius:5px; background-color:rgb(177, 28, 2); "
                            class="btn btn-xs  btn-sm mr-1">Inactive</span>';
                        }
        
        return $status;
            
        })

       ->addColumn('action', function ($package) {
                $status = '';
                $edit = '';
                $delete = '';
                $view = '';
                if (check_access("package.edit")) {
                    if ($package->status == 1) {
                        $status =
                            "<a href='" . route("package.status", $package->id) . "' style='padding:2px;'
                        class='btn btn-xs btn-success btn-sm mr-1'>
                        <svg  width='16' height='14' viewBox='0 0 24 24'
                            fill='none' stroke='currentColor' stroke-width='2'
                            stroke-linecap='round' stroke-linejoin='round'
                            class='feather feather-arrow-up'>
                            <line x1='12' y1='19' x2='12' y2='5'>
                            </line>
                            <polyline points='5 12 12 5 19 12'></polyline>
                        </svg></a>
                        ";
                    } else {
                        $status =
                            "<a href='" . route("package.status", $package->id) . "'
                            style='padding:2px;background-color:rgb(202, 63, 82); color:white'
                            class='btn btn-xs btn-sm mr-1'><svg width='16' height='14'
                                viewBox='0 0 26 26' fill='none' stroke='currentColor'
                                stroke-width='2' stroke-linecap='round' stroke-linejoin='round'
                                class='feather feather-arrow-down'>
                                <line x1='12' y1='5' x2='12' y2='19'>
                                </line>
                                <polyline points='19 12 12 19 5 12'></polyline>
                            </svg></a>
                    ";

                    }


                }
                if (check_access("package.list")) {
                    $view = ' <a href=""  data-bs-toggle="modal" 
                    data-bs-target=".image_modal-' . $package->id . '" style="padding:2px; margin-left:3px; color:white"
                    class="btn btn-xs btn-info btn-sm mr-1">
                    <svg  width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </a>';
                }
                if (check_access("package.edit")) {
                    $edit = '<a href="' . route('package.edit', $package->id) . '" style="padding:2px; margin-left:3px"
                    class="btn btn-xs btn-primary btn-sm mr-1">
                    <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>';
                }
                if (check_access("package.delete")) {
                    $delete = '<a href="' . route('package.delete', $package->id) . '"
                        onclick="return confirm("Are you sure you want to delete?");"
                        style="padding: 2px; margin-left:3px;" class="delete btn btn-xs btn-danger btn-sm mr-1"><svg
                        width="16" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-trash-2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path
                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                        </path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg></a>';
                }

                return $status . $view . $edit . $delete;
            })



        ->rawColumns(['branch_name','package_type','category','name','amount','short_details','status','action'])
        ->make(true);
    }

    public function addPackage(){
        if (!check_access("package.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $branches = PackageBranch::get();
        $types = PackageType::get();
        $categories = PackageCategory::get();
        return view('BackEnd.package.package.create',compact('branches','types','categories'));
    }

    public function storePackage(Request $request){
        $validators = Validator::make($request->all(),[
            'package_type_id' => 'required',
            'package_category_id' => 'required',
            'package_branch_id' => 'required',
            'name' => 'required',
            // 'position' => 'required',
            'short_details' => 'required',
            'long_details' => 'required',
        ]);
    
        if($validators->fails()){
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        if($request->hasFile('image')){ 
            $file = $request->file('image'); 
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $image_name = $image_enc_name.".".$image_extension; 
             
            $destination_path = "backend/package/"; 
            $file->move($destination_path,$image_name); 
        }else{ 
            $image_name=""; 
        }
            $category = PackageCategory::where('id',$request['package_category_id'])->first();
        $data = [
            'package_type_id' => $request['package_type_id'],
            'package_category_id' => $request['package_category_id'],
            'package_branch_id' => $request['package_branch_id'],
            'pkg_image' => $image_name,
            'name' => $request['name'],
            'slug' => Str::slug($category->category_name).'~'.Str::slug($request['name']),
            'position' => $request['position'],
            'short_title' => $request['short_title'],
            'amount' => $request['amount'],
            'discount' => $request['discount'],
            'duration' => $request['duration'],
            'short_details' => $request['short_details'],
            'long_details' => $request['long_details'],
            'status' => 1
        ];
        // dd($data);

        Package::create($data);
        

        Toastr::success("Data Inserted Successfully!");
        return redirect()->route('package');

    }

    public function StatusUp($id){
        try{
            if (!check_access("package.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = Package::find($id);
            // dd($status);
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

    public function edit_package($id)
    {
        if (!check_access("package.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $branches = PackageBranch::get();
        $types = PackageType::get();
        $categories = PackageCategory::get();
        $package_edit = Package::findOrfail($id);
        return view('BackEnd.package.package.edit',compact('package_edit','branches','types','categories'));
    }

    public function update_package(Request $request, $id)
    {

        $package_update = Package::findOrfail($id);

        $image_name = $package_update->pkg_image;

        $validator = Validator::make($request->all(),[
            'package_type_id' => 'required',
            'package_category_id' => 'required',
            'package_branch_id' => 'required',
            // 'duration' => 'required',
            'long_details' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){ 
            $path = public_path() . "backend/package/" . $package_update->pkg_image;
            if (file_exists($path)) { 
                unlink($path); 
            }
            $file = $request->file('image'); 
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $image_name = $image_enc_name.".".$image_extension; 
            $destination_path = "backend/package/"; 
            $file->move($destination_path,$image_name); 
        }

        $package_update->update([
            'package_type_id' => $request['package_type_id'],
            'package_category_id' => $request['package_category_id'],
            'package_branch_id' => $request['package_branch_id'],
            'pkg_image' => $image_name,
            'name' => $request['name'],
            'position' => $request['position'],
            'slug' => Str::slug($package_update->slug) ? Str::slug($package_update->slug):Str::slug($package_update->category->category_name).'~'.Str::slug($request['name']),
            'short_title' => $request['short_title'],
            'amount' => $request['amount'],
            'discount' => $request['discount'],
            'duration' => $request['duration'],
            'short_details' => $request['short_details'],
            'long_details' => $request['long_details'],
            'status' => 1
        ]);

        Toastr::success('message','Data Updated Successfully');

        return redirect()->route('package')->with('message','Data Updated Successfully!');
    }

    public function destroy_package($id){
        if (!check_access("package.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $package_delete = Package::find($id);
        $package_delete -> delete();
        return redirect()->route('package')->with('message','Deleted Successfully!');
    }

}
