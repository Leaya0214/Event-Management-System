<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\BackEnd\Portfolio;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\PortfolioGallery;
use App\Models\BackEnd\PortfolioCategory;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{


    //===============================Portfolio Category=================//


    public function category(){
        if (!check_access("portfolio.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $portfolioCategories = PortfolioCategory::all();
        return view('BackEnd.webcontent.portfolio.manageCategory',compact('portfolioCategories'));

    }
    public function storePortfolioCategory(Request $request){
        if (!check_access("portfolio.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $validator = Validator::make($request->all(),[
            'name' =>'required',
        ]);
        if($validator->fails()){
            Toastr::error("Invalid Data given!");
            return redirect()->back()->withErrors($validator)->withInput();
        }
      
        $data = [
            'name' => $request['name'],
            'status' => 1
        ];

        // dd($data );

        PortfolioCategory::insert($data);

        Toastr::success("New Category Added !");

        return redirect()->route('portfolio.category');

    }
    public function updatePortfolioCategory(Request $request, $id){
        if (!check_access("portfolio.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $validator = Validator::make($request->all(),[
            'name' =>'required',
        ]);
        if($validator->fails()){
            Toastr::error("Invalid Data given!");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = PortfolioCategory::findOrFail($id);
      
        $data = [
            'name' => $request['name'],
            'status' => 1
        ];

        // dd($data );
        $category->update($data);

        Toastr::success("Category Updated Successfully !");

        return redirect()->route('portfolio.category');
    }
    public function categoryStatusUpdate($id){
        try{
            if (!check_access("portfolio.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = PortfolioCategory::find($id);
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
    public function deleteCategory($id){
        try{
            if (!check_access("portfolio.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $category = PortfolioCategory::find($id);
            $category -> delete();
            Toastr::success("Deleted Successfully!");
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    //===============================Portfolio=================//

    public function index(){
        if (!check_access("portfolio.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $portfolios = Portfolio::all();
        $portfolioCategories = PortfolioCategory::all();
        return view('BackEnd.webcontent.portfolio.index',compact('portfolios','portfolioCategories'));
    }

    public function getallPortfolio(){
        if (!check_access("portfolio.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $portfolios = Portfolio::orderby('id','desc')->get();
        return DataTables::of($portfolios)
        ->addIndexColumn()
        ->setRowId(function($portfolio){return $portfolio->id;})
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('type',function($portfolio){
            $type = $portfolio->type;
            return $type;
        })
        ->addColumn('image',function($portfolio){
            $url = asset("backend/portfolio/".$portfolio->image);
            $image = '<img src="'.$url.'" style="width:100px;height: 70px;"  id="myImg">';
            return $image;
        })
        ->addColumn('status',function($portfolio){
            if($portfolio->status == 1) {
                $status = 
                    '<span
                    style="background-color: rgb(66, 134, 66); color:white; border-radius:5px;"
                    class="btn btn-xs btn-sm mr-1">Active</span>' ;
            }else{
                $status = 
                '<span style="color:white; border-radius:5px; background-color:rgb(177, 28, 2); "
                class="btn btn-xs  btn-sm mr-1">Inactive</span>';
            }
        
        return $status;
            
        })

        ->addColumn('action', function ($portfolio) {
            $status = '';
            $view = '';
            $edit = '';
            $delete = '';
            if (check_access("portfolio.edit")) {
            if($portfolio->status == 1) {
                $status = 
                    "<a href='".route("portfolio.status", $portfolio->id) ."' style='padding:2px;'
                        class='btn btn-xs btn-success btn-sm mr-1'>
                        <svg  width='16' height='14' viewBox='0 0 24 24'
                            fill='none' stroke='currentColor' stroke-width='2'
                            stroke-linecap='round' stroke-linejoin='round'
                            class='feather feather-arrow-up'>
                            <line x1='12' y1='19' x2='12' y2='5'>
                            </line>
                            <polyline points='5 12 12 5 19 12'></polyline>
                        </svg></a>
                        " ;
                } else{
                        $status = 
                        "<a href='".route("portfolio.status", $portfolio->id) ."'
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
                if (check_access("portfolio.list")) {

            $view = ' <a href=""  data-bs-toggle="modal" 
                    data-bs-target=".image_modal-'.$portfolio->id.'" style="padding:2px; margin-left:3px; color:white"
                    class="btn btn-xs btn-info btn-sm mr-1">
                    <svg  width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </a>';
                }
                if (check_access("portfolio.edit")) {
            $edit = '<a href="'.route('portfolio.edit',$portfolio->id).'" style="padding:2px; margin-left:3px"
                    class="btn btn-xs btn-primary btn-sm mr-1">
                    <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>';
                }
                if (check_access("portfolio.delete")) {

            $delete = '<a href="'.route('portfolio.delete',$portfolio->id).'"
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

            return  $status . $view . $edit . $delete ;
        })


        ->rawColumns(['type','image','status','action'])
        ->make(true);
    }


    public function addPortfolio(){
        if (!check_access("portfolio.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $portfolioCategories = PortfolioCategory::where('status',1)->get();
        return view('BackEnd.webcontent.portfolio.create',compact('portfolioCategories'));
    }

    public function storePortfolio(Request $request){
        if (!check_access("portfolio.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $validators = Validator::make($request->all(),[
            'image' => ['required','mimes:jpg,png,svg,jpeg,gif',]
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
             
            $destination_path = "backend/portfolio/"; 
            $file->move($destination_path,$image_name); 
        }else{ 
            $image_name=""; 
        }

        $category = [];

        $category_ids = $request->category_id;
        // dd($category_ids);
        if( $category_ids){
            foreach($category_ids as $category_id){
                $category[] = (int)$category_id;
            }
            $categories = json_encode($category);
        }else{
            $categories = '';
        }
       
        // dd($category);

        //  dd($categories);
        $data = [
            'type'=>$request->type,
            'title'=>$request->title,
            'category_id'=>$categories,
            'image' => $image_name,
            'video' => $request->video,
            'description' => $request->description,
            'status' => 1
        ];

         $portfolio = Portfolio::create($data);
        
         if($files = $request->file('gallery')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $filename = $file->move('backend/portfolio_gallery/',time().'-'.$name);
                $data = getimagesize($filename);
                $width = $data[0];
                $height = $data[1];

                $gallery = time().'-'. $name;

                PortfolioGallery::create([
                    'portfolio_id' =>  $portfolio->id,
                    'image' => $gallery,
                    'width' => $width,
                    'height' => $height,
                ]);

            }
        }
        Toastr::success("Data Inserted Successfully!");
        return redirect()->route('portfolio');

    }

    public function edit($id){
        if (!check_access("portfolio.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $portfolio = Portfolio::where('id',$id)->first();
        $portfolioCategories = PortfolioCategory::where('status',1)->get();
        $portfolio_gallery = PortfolioGallery::where('portfolio_id',$id)->get();
        $portfolio_category_ids = json_decode($portfolio->category_id);
        return view('BackEnd.webcontent.portfolio.edit',compact('portfolio','portfolio_gallery','portfolioCategories','portfolio_category_ids'));
    }
    public function update(Request $request, $id){
        if (!check_access("portfolio.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $portfolio = Portfolio::where('id',$id)->first();
        $image_name = $portfolio->image;
        // $video = $portfolio->video;

        if($request->hasFile('image')){ 
            $file = $request->file('image'); 
            $path = public_path() . "backend/portfolio/" . $portfolio->image;
            if (file_exists($path)) { 
                unlink($path); 
            }
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $image_name = $image_enc_name.".".$image_extension; 
             
            $destination_path = "backend/portfolio/"; 
            $file->move($destination_path,$image_name); 
        }

        $category = [];

        $category_ids = $request->category_id;
        if( $category_ids){
            foreach($category_ids as $category_id){
                $category[] = (int)$category_id;
            }
            $categories = json_encode($category);
        }else{
            $categories = '';
        }

        // dd($categories);

        $data = [
            'type'=>$request->type,
            'title'=>$request->title,
            'category_id' => $categories,
            'image' => $image_name,
            'video' => $request->video,
            'description' => $request->description,
            'status' => 1
        ];
        $portfolio->update($data);

        if($files = $request->file('gallery')){
            foreach($files as $file){
                $path = public_path() . "backend/portfolio_gallery/" . $file->image;
                if (file_exists($path)) { 
                    unlink($path); 
                }
                $name = $file->getClientOriginalName();
                $filename = $file->move('backend/portfolio_gallery/',time().'-'.$name);
               
                $data = getimagesize($filename);
                $width = $data[0];
                $height = $data[1];

                $gallery = time().'-'. $name;

                PortfolioGallery::create([
                    'portfolio_id' =>  $portfolio->id,
                    'image' => $gallery,
                    'width' => $width,
                    'height' => $height,
                ]);

            }
        }

        Toastr::success("Data Updated Successfully!");
        return redirect()->route('portfolio');
    }
    public function statusUpdate($id){
        try{
            if (!check_access("portfolio.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = Portfolio::find($id);
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
    public function destroy($id){

        try{
            if (!check_access("portfolio.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $data = Portfolio::find($id);
            $data->delete();
            Toastr::success("Deleted Successfully !!");
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function deleteGalleryImage($id){
        try{
            if (!check_access("portfolio.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $data = PortfolioGallery::find($id);
            $data->delete();
            Toastr::success("Deleted Successfully !!");
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }

}
