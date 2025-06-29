<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\User;
use App\Models\BackEnd\Blog;
use Illuminate\Http\Request;
use App\Models\BackEnd\Package;
use App\Models\BackEnd\Service;
use App\Models\BackEnd\Overview;
use App\Models\BackEnd\Portfolio;
use App\Models\BackEnd\PackageType;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\District;
use App\Models\BackEnd\EventShift;
use App\Models\BackEnd\EventType;
use App\Models\BackEnd\PackageBranch;
use App\Models\BackEnd\SystemSetting;
use App\Models\BackEnd\PackageCategory;
use App\Models\BackEnd\TeamMember;
use App\Models\BackEnd\PortfolioCategory;
use App\Models\BackEnd\PortfolioGallery;




class WebsiteController extends Controller
{
    public function our_work()
    {
        $photographies = Portfolio::where('type','Photography')->where('status',1)->get();
        $cinematographies = Portfolio::where('type','Cinematography')->where('status',1)->get();
        return view('FrontEnd.website.our_work.our_work', compact('photographies','cinematographies'));
    }

    public function our_work_view($id,$name)
    {
         $our_work_view = Portfolio::find($id);
        //to Show 2 landscape and 1 portrait
        $gallery_image = PortfolioGallery::where('portfolio_id', $id)->get();

        $first_row = PortfolioGallery::where('portfolio_id', $id)
                    ->where(function ($query) {
                        $query->where('width', '>=', 2000)->where('height', '>=', 1000)
                            ->orWhere(function ($query) {
                                $query->where('width', '<=', 2000)->orWhere('height', '<=', 2000);
                            });
                    })
                    ->limit(3)
                    ->get();

        $firts_row_ids = $first_row->pluck('id')->toArray();

        //To show Two Landscape Images
        $second_row = PortfolioGallery::where('portfolio_id', $id)
        ->where('width', '>=', 2000)
        ->whereNotIn('id',$firts_row_ids)
        ->take(2)
        ->get();

        $second_row_ids = $second_row->pluck('id')->toArray();
        

        // dd($first_row);

         //To show One landscape and Two portrait
         $galleryImages = PortfolioGallery::where('portfolio_id', $id)
                        ->whereNotIn('id',array_merge($firts_row_ids,$second_row_ids))
                        ->take(3) // Take the top 3 results
                        ->get();

        $third_row_ids = $galleryImages->pluck('id')->toArray();
        $others = PortfolioGallery::where('portfolio_id',$id)->whereNotIn('id', array_merge($firts_row_ids,$second_row_ids,$third_row_ids))
                    ->get();


        // dd($gallery_image);
        return view('FrontEnd.website.our_work.our_work_view', compact('our_work_view','first_row','second_row','others','galleryImages','gallery_image'));
    }

    public function our_story()
    {
        $our_story = Overview::where('type','About Us')->get();
        return view('FrontEnd.website.our_story', compact('our_story'));
    }

    public function packages($id,$branch)
    {
        $branch = PackageBranch::where('id',$id)->first();
        $package_type = PackageType::where('status',1)->get();
        $package_category = PackageCategory::where('status',1)->get();
        $packages = Package::where('package_branch_id',$id)->where('status',1)->orderBy('position','asc')->get();
        return view('FrontEnd.website.package.packages', compact('package_type','package_category','packages','branch'));
    }

    public function packageBranch(){
        $branches = PackageBranch::where('status',1)->get();
        return view('FrontEnd.website.package.package_branch',compact('branches'));
    }


    public function blog(){
        $blogs = Blog::where('status',1)->get();
        return view('FrontEnd.website.blog.all_blog',compact('blogs'));
    }

    public function blog_details($id, $title){
        $blog = Blog::where('id',$id)->first();
        return view('FrontEnd.website.blog.blog_details',compact('blog'));
    }

    public function aboutUs(){
        $content = Overview::where('type','About Us')->where('status',1)->first();
        $services = Service::where('status',1)->get();
        $users  = TeamMember::where('status',1)->get();

        return view('FrontEnd.website.about_us.about_us',compact('content','services','users'));
    }

    public function crew_details($id,$name){
        $crew = User::where('id',$id)->first();
    //    dd($crew);
        return view('FrontEnd.website.about_us.details',compact('crew'));
    }

    public function services(){
        $services = Service::where('status',1)->get();
        return view('FrontEnd.website.services.services',compact('services'));
    }

    public function serviceDetails($id,$service){
        $service = Service::where('id',$id)->first();
        return view('FrontEnd.website.services.service_details',compact('service'));
    }


    public function book_us(){
        $package_type=PackageType::all();
        $package_category=PackageCategory::where('status',1)->get();
        $package = Package::where('status',1)->get();
        $shifts = EventShift::where('status',1)->get();
        $types = EventType::where('status',1)->get();
        $districts = District::where('status',1)->get();
        return view('FrontEnd.website.book_us',compact('package_type','package','package_category','shifts','types','districts'));
    }

    public function contact(){
        $info = SystemSetting::first();
        return view('FrontEnd.website.contact_us',compact('info'));
    }
    public function getModalContent($id){
        $currentUrl =  route('copiedText', ['id' => $id]);
        $package=Package::find($id);
        return view('FrontEnd.website.package.modal', compact('package','currentUrl'));
    }

    public function copied_content($id){
        $package = Package::find($id);
        return view('FrontEnd.website.package.package_details', compact('package'));

    }

    public function photography(){
        $photographies = Portfolio::where('type','Photography')->where('status',1)->orderBy('id','desc')->get();
        $categories = PortfolioCategory::where('status',1)->get();
        return view('FrontEnd.website.portfolio.photography',compact('photographies','categories'));

    }
    public function cinematography(){
        $cinematographies = Portfolio::where('type','Cinematography')->where('status',1)->get();
        return view('FrontEnd.website.portfolio.cinematography',compact('cinematographies'));

    }
    
     public function termsAndCondition(){
        $data = Overview::where('type','Terms&Condition')->first();
        // dd($data);
        return view('FrontEnd.website.terms_condition',compact('data'));
    }
    public function privacyPolicy(){
        $data = Overview::where('type','Privacy Policy')->first();
        return view('FrontEnd.website.privacy_policy',compact('data'));
    }
    
    
    public function categoryWisePackage($id,$branch,$name){
        $packages = Package::where('package_category_id',$id)->where('package_branch_id',$branch)->get();
        return view('FrontEnd.website.package.category_package',compact('packages'));
    }

   

}
