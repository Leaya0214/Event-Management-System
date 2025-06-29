<?php

use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LoginController;
use PHPUnit\Logging\TeamCity\TeamCityLogger;
use App\Http\Controllers\BackEnd\BlogController;
use App\Http\Controllers\BackEnd\RoleController;
use App\Http\Controllers\BackEnd\UserController;
use App\Http\Controllers\BackEnd\EventController;
use App\Http\Controllers\BackEnd\StuffController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\BackEnd\ClientController;
use App\Http\Controllers\BackEnd\SliderController;
use App\Http\Controllers\BackEnd\PackageController;
use App\Http\Controllers\BackEnd\PaymentController;
use App\Http\Controllers\BackEnd\ServiceController;
use App\Http\Controllers\BackEnd\OverviewController;
use App\Http\Controllers\FrontEnd\BookingController;
use App\Http\Controllers\FrontEnd\WebsiteController;
use App\Http\Controllers\BackEnd\DashboardController;
use App\Http\Controllers\BackEnd\PortfolioController;
use App\Http\Controllers\BackEnd\StaffPanelController;
use App\Http\Controllers\BackEnd\TeamMemberController;
use App\Http\Controllers\BackEnd\ClientReviewController;
use App\Http\Controllers\BackEnd\SystemSettingController;
use App\Http\Controllers\FrontEnd\ClientLoginController;
use App\Http\Controllers\FrontEnd\ClientProfileController;
use App\Http\Controllers\SendsmsController;
use App\Http\Controllers\BackEnd\AccountController;
use App\Http\Controllers\BackEnd\EventExpenseController;
use App\Http\Controllers\BackEnd\SingleEventController;







/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
|
*/
//==============================FrontEnd Controller Start ===========================//
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/login',[ClientLoginController::class,'loginPage'])->name('login');
Route::post('/submit-login',[ClientLoginController::class,'submitLogin'])->name('submit-login');
Route::get('/client-logout',[ClientLoginController::class,'logout'])->name('client-logout');

Route::controller(WebsiteController::class)->group(function(){
    //Our Work
    Route::get('our_work',[WebsiteController::class, 'our_work'])->name('our_work');
    Route::get('our_work_view/{id}/{name}',[WebsiteController::class, 'our_work_view'])->name('our_work_view');
    //Our Story
    Route::get('our_story',[WebsiteController::class,'our_story'])->name('our_story');
    //Packages
    Route::get('branches/package',[WebsiteController::class,'packageBranch'])->name('branchwisepackage');
    Route::get('packages/{id}/{branch}',[WebsiteController::class,'packages'])->name('packages');
    Route::get('package/{id}/{branch}/{name}',[WebsiteController::class,'categoryWisePackage'])->name('category_package');


    //blog
    Route::get('blogs',[WebsiteController::class,'blog'])->name('blogs');
    Route::get('images',[WebsiteController::class,'images'])->name('images');
    Route::get('blog_details/{id}/{blog}',[WebsiteController::class,'blog_details'])->name('blog_details');


    //About Us
    Route::get('about_us',[WebsiteController::class,'aboutUs'])->name('about_us');
    Route::get('about/{id}/{name}',[WebsiteController::class,'crew_details'])->name('crew_details');

    //services
    Route::get('allservices',[WebsiteController::class,'services'])->name('allservices');
    Route::get('service_details/{id}/{service}',[WebsiteController::class,'serviceDetails'])->name('service_details');

    //Book us
    Route::get('book_us',[WebsiteController::class,'book_us'])->name('book_us');
    Route::get('contact',[WebsiteController::class,'contact'])->name('contact');

    //modal Content
    Route::get("/getModalContent/{id}", [WebsiteController::class,'getModalContent']);
    Route::get("/package_details/{id}", [WebsiteController::class,'copied_content'])->name('copiedText');

    //Portfolio
    Route::get("/photography/", [WebsiteController::class,'photography'])->name('photography');
    Route::get("/cinematography/", [WebsiteController::class,'cinematography'])->name('cinematography');

    //Booking Route

    Route::post("/booking/store", [BookingController::class,'booking_data_store'])->name('booking.store');
    Route::get("/filter", [BookingController::class,'filterPackage'])->name('filterPackage');
    Route::get("/packageDetails", [BookingController::class,'packageDetails'])->name('packageDetails');

       //Terms & Condition || Privacy Policy
    Route::get('terms&condition',[WebsiteController::class,'termsAndCondition'])->name('terms_condition');
    Route::get('Privacy/Policy',[WebsiteController::class,'privacyPolicy'])->name('privacy_policy');



});
    //Client Profile
  Route::group(['middleware' => 'client'],function(){
    Route::controller(ClientProfileController::class)->prefix('user-profile')->group(function(){
          Route::get('/','profile')->name('user-profile');
          Route::get('/client-info','profile')->name('client-info');
          Route::get('/event-modal/{id}','eventModalforPhoto')->name('event-modal');
          Route::get('/payment-info','paymentInfo')->name('payment-info');
          Route::get('/artist-details','artistDetails')->name('artist-details');
          Route::post('/store-info','storeNotes')->name('store-info');
          Route::get('/getDetail','getAllEvents')->name('getDetail');
          Route::get('/getClientPayment','getAllPayment')->name('getClientPayment');
          Route::get('/shareExperience','shareExperience')->name('shareExperience');
          Route::post('/clientReviewStore','clientReviewStore')->name('clientReviewStore');
      });
});

//==============================FrontEnd Controller End ===========================//


//==============================LoginController Start ===========================//
Route::get('/adminlogin', [LoginController::class, 'loginIndex'])->name('admin.login');
Route::post('/adminlogin/submit', [LoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
|   Admin Access Start From Here
|--------------------------------------------------------------------------
*/

// Route::group(['middleware' => 'IsAdmin'],function(){

    //DashboardController Route
     Route::get('/admindashboard',[DashboardController::class,'index'])->name('admin.index');
     Route::get('/stuffdashboard',[DashboardController::class,'stuffDashboard'])->name('dashboard.stuff');

     //SystemSetting Route
     Route::get('/system/setting',[SystemSettingController::class,'index'])->name('system.setting');
     Route::post('/system/setting/store',[SystemSettingController::class,'storeSystemInfo'])->name('system.setting.store');
     Route::post('/system/setting/update/{id}',[SystemSettingController::class,'updateInfo'])->name('system.setting.update');

     //Slider Route
     Route::controller(SliderController::class)->prefix('slider')->group(function(){
        Route::get('','index')->name('slider');
        Route::post('/store','storeSlider')->name('slider.store');
        Route::post('/update/{id}','updateSlider')->name('slider.update');
        Route::get('/status/{id}','statusUpdate')->name('slider.status');
        Route::get('/delete/{id}','deleteSlider')->name('slider.delete');
    });

     //Service Route
     Route::controller(ServiceController::class)->prefix('service')->group(function(){
        Route::get('','index')->name('service');
        Route::get('/add', 'addService')->name('service.add');
        Route::post('/store','storeService')->name('service.store');
        Route::get('/edit/{id}', 'edit')->name('service.edit');
        Route::post('/update/{id}','updateService')->name('service.update');
        Route::get('/status/{id}','statusUpdate')->name('service.status');
        Route::get('/delete/{id}','delete')->name('service.delete');
    });

     //Client Review Route
     Route::controller(ClientReviewController::class)->prefix('client_review')->group(function(){
        Route::get('','index')->name('client_review');
        Route::get('/add', 'addClientReview')->name('client_review.add');
        Route::post('/store','storeClientReview')->name('client_review.store');
        Route::get('/edit/{id}', 'edit')->name('client_review.edit');
        Route::post('/update/{id}','updateClientReview')->name('client_review.update');
        Route::get('/status/{id}','statusUpdate')->name('client_review.status');
        Route::get('/delete/{id}','delete')->name('client_review.delete');
    });

     //Overview Controller Route
     Route::controller(OverviewController::class)->prefix('content')->group(function(){
        Route::get('','index')->name('content');
        Route::get('/add', 'addOverview')->name('content.add');
        Route::post('/store','store')->name('content.store');
        Route::get('/edit/{id}', 'edit')->name('content.edit');
        Route::post('/update/{id}','update')->name('content.update');
        Route::get('/status/{id}','statusUpdate')->name('content.status');
        Route::get('/delete/{id}','destroy')->name('content.delete');
    });

     Route::controller(BlogController::class)->prefix('blog')->group(function(){
        Route::get('','index')->name('blog');
        Route::get('/add', 'addBlog')->name('blog.add');
        Route::get('/getAll', 'getAll')->name('blog.all');
        Route::post('/store','storeBlog')->name('blog.store');
        Route::get('/edit/{id}', 'edit')->name('blog.edit');
        Route::post('/update/{id}','update')->name('blog.update');
        Route::get('/status/{id}','statusUpdate')->name('blog.status');
        Route::get('/delete/{id}','destroy')->name('blog.delete');
        Route::get('/image/{id}','deleteImage')->name('image.delete');
    });

     Route::controller(PortfolioController::class)->prefix('portfolio')->group(function(){
        Route::get('','index')->name('portfolio');
        Route::get('/add', 'addPortfolio')->name('portfolio.add');
        Route::get('/getportfolio', 'getallPortfolio')->name('portfolio.all');
        Route::post('/store','storePortfolio')->name('portfolio.store');
        Route::get('/edit/{id}', 'edit')->name('portfolio.edit');
        Route::post('/update/{id}','update')->name('portfolio.update');
        Route::get('/status/{id}','statusUpdate')->name('portfolio.status');
        Route::get('/delete/{id}','destroy')->name('portfolio.delete');
        Route::get('/image/{id}','deleteGalleryImage')->name('portfolio_image.delete');
    });
     Route::controller(PortfolioController::class)->prefix('portfolio_category')->group(function(){
        Route::get('','category')->name('portfolio.category');
        Route::post('/store','storePortfolioCategory')->name('portfolio.category.store');
        Route::post('/update/{id}','updatePortfolioCategory')->name('portfolio.category.update');
        Route::get('/status/{id}','categoryStatusUpdate')->name('portfolio.category.status');
        Route::get('/delete/{id}','deleteCategory')->name('portfolio.category.delete');
    });

    Route::controller(TeamMemberController::class)->prefix('member')->group(function () {
      Route::get('/', 'index')->name('member');
      Route::get('/create', 'createMember')->name('member.create');
      Route::post('/create', 'storeMember')->name('member.store');
      Route::get('/getUser', 'allMember')->name('member.getUser');
      // Route::get('/profile', 'profile')->name('user.profile');
      Route::get('/edit/{id}', 'editMember')->name('member.edit');
      Route::post('/edit/{id}', 'updateMember')->name('member.update');
      Route::get('/status/{id}', 'statusUpdate')->name('member.status');
      Route::get('/delete/{id}', 'delete')->name('member.delete');
  });


    //Package Route
    Route::controller(PackageController::class)->prefix('package_type')->group(function(){
        Route::get('','index')->name('package_type');
        Route::get('/add','addPackage_type')->name('package_type.add');
        Route::post('/store','storePackage_type')->name('package_type.store');
        Route::get('/status/{id}','statusUpdate')->name('package_type.status');
        Route::get('/edit/{id}', 'edit')->name('package_type.edit');
        Route::post('/update/{id}','update')->name('package_type.update');
        Route::get('/delete/{id}','destroy')->name('package_type.delete');
  });

  Route::controller(PackageController::class)->prefix('package_category')->group(function(){
        Route::get('','package_category_index')->name('package_category');
        Route::get('/add','addPackage_category')->name('package_category.add');
        Route::post('/store','storePackage_category')->name('package_category.store');
        Route::get('/status/{id}','status_update')->name('package_category.status');
        Route::get('/edit/{id}', 'edit_category')->name('package_category.edit');
        Route::post('/update/{id}','update_category')->name('package_category.update');
        Route::get('/delete/{id}','destroy_category')->name('package_category.delete');
  });

  Route::controller(PackageController::class)->prefix('package_branch')->group(function(){
        Route::get('','package_branch_index')->name('package_branch');
        Route::get('/add','addPackage_branch')->name('package_branch.add');
        Route::post('/store','storePackage_branch')->name('package_branch.store');
        Route::get('/status/{id}','status_up')->name('package_branch.status');
        Route::get('/edit/{id}', 'edit_branch')->name('package_branch.edit');
        Route::post('/update/{id}','update_branch')->name('package_branch.update');
        Route::get('/delete/{id}','destroy_branch')->name('package_branch.delete');
  });

  Route::controller(PackageController::class)->prefix('all_package')->group(function(){
        Route::get('','package_index')->name('package');
        Route::get('/add','addPackage')->name('package.add');
        Route::post('/store','storePackage')->name('package.store');
        Route::get('/getAll','getAllPackage')->name('package.all');
        Route::get('/status/{id}','StatusUp')->name('package.status');
        Route::get('/edit/{id}', 'edit_package')->name('package.edit');
        Route::post('/update/{id}','update_package')->name('package.update');
        Route::get('/delete/{id}','destroy_package')->name('package.delete');
  });

  //Event Route

  Route::controller(EventController::class)->prefix('shift')->group(function(){
    Route::get('','shiftIndex')->name('shift');
    Route::post('/store','shiftStore')->name('shift.store');
    Route::get('/status/{id}','shiftStatus')->name('shift.status');
    Route::post('/update/{id}','shiftUpdate')->name('shift.update');
    Route::get('/delete/{id}','shiftDelete')->name('shift.delete');
});

  Route::controller(EventController::class)->prefix('event_type')->group(function(){
    Route::get('','typeIndex')->name('event_type');
    Route::post('/store','typeStore')->name('type.store');
    Route::get('/status/{id}','typeStatus')->name('type.status');
    Route::post('/update/{id}','typeUpdate')->name('type.update');
    Route::get('/delete/{id}','typeDelete')->name('type.delete');
});

  Route::controller(EventController::class)->prefix('district')->group(function(){
    Route::get('','district')->name('district');
    Route::post('/store','storeDistrict')->name('district.store');
    Route::get('/status/{id}','districtStatus')->name('district.status');
    Route::post('/update/{id}','updateDistrict')->name('district.update');
    Route::get('/delete/{id}','deleteDistrict')->name('district.delete');
});

Route::controller(EventController::class)->prefix('event')->group(function(){
  Route::get('','Events')->name('event_info');
  Route::get('/addNew/{id}','addNewEvent')->name('event.add');
  Route::post('/sitore','storeEvents')->name('event.store');
  Route::get('/edit/{id}','editEvent')->name('event.edit');
  Route::post('/update/{id}','updateEvent')->name('event.update');
  Route::get('/getAll','getAllEvents')->name('allEvent');
  Route::put('/status/{id}','eventstatusUpdate')->name('status.event');
//   Route::post('/delete/{id}','deleteMaster')->name('delete.event');
  Route::delete('/delete/{id}','deleteMaster')->name('delete.event');

  Route::post('/assignEvent','assignEvent')->name('assignEvent');
  Route::get('/packageFilter','filterPackage')->name('package.filter');
  Route::get('/details_package','packageDetails')->name('package.details');
  Route::get('/deletefootage/{id}','deleteFootage')->name('delete.footage');
  Route::get('/filterEvent','filterEvent')->name('filterEvent');
  Route::get('/invoice/{id}','invoice')->name('invoice');
  Route::post('/experience/store','experinceStore')->name('experinceStore');
  Route::get('/load-modal/{id}/{role}', 'loadModal')->name('load.modal');
  Route::get('/status-modal/{id}', 'showStatusModal')->name('status.modal');
  Route::get('/view-modal/{id}', 'viewModal')->name('view.modal');
  Route::get('/log-modal/{id}', 'logModal')->name('log.modal');
  Route::get('/share-experience-modal/{id}', 'shareExperince')->name('share.experience.modal');
  Route::get('/view-experience-modal/{id}', 'viewExperince')->name('view.experience.modal');
});


Route::get('/list',[EventController::class,'assignEventList'])->name('assign-list');
Route::get('/assigndata/edit/{id}',[EventController::class,'assignEventEdit'])->name('assign.edit');
Route::post('/assigndata/update/{id}',[EventController::class,'updateAssignEventData'])->name('assigtn.event.update');
Route::get('/allEvent',[EventController::class,'getAssignedList'])->name('assign-event-list');
Route::get('/userType',[EventController::class,'userType'])->name('user.type');
Route::delete('/deleteAssignUser/{id}',[EventController::class,'deleteAssignUser'])->name('delete.assign.user');






//========================== Single Event Controller ================================//
Route::get('/single-list',[SingleEventController::class,'index'])->name('singleevent-list');
Route::get('/get-event-list',[SingleEventController::class,'getAllSingleEvent'])->name('get-list');


//========================== ClientController ================================//


Route::get('/client-index',[ClientController::class,'clientIndex'])->name('client-index');
Route::get('/allClient',[ClientController::class,'getAllClient'])->name('allClient');
Route::get('/client-edit/{id}',[ClientController::class,'editClient'])->name('client-edit');
Route::post('/client-update/{id}',[ClientController::class,'updateClient'])->name('client-update');
Route::get('/client-delete/{id}',[ClientController::class,'clientstatusInactive'])->name('client-inactive');


//========================== PaymentController  ================================//


Route::controller(PaymentController::class)->prefix('payment')->group(function(){
  Route::get('/clients','clientPayment')->name('client.payment');
  Route::get('/getAll','getClientPayment')->name('client.getAll');
  Route::get('/edit/{id}','editClientPayment')->name('client.payment.edit');
  Route::post('/update/{id}','paymentUpdate')->name('client.payment.update');
  Route::get('/staff/create/{id}','createStaffPayment')->name('staff.payment.create');
  Route::post('/staff/store','storestaffPayment')->name('staff.payment.store');
  Route::get('/staffs','staffPayment')->name('payment.staff');
  Route::get('/getPayments','getStaffPayment')->name('staff.getAll');
  Route::get('/filterPayment','filterPayment')->name('payment.filter');
  Route::get('/paymentHistory','paymentHistory')->name('payment.history');
});

Route::controller(AccountController::class)->prefix('account')->group(function(){
  Route::get('/expense-category','categoryindex')->name('expense.category');
  Route::post('/expense-category/store','storeCategory')->name('category.store');
  Route::get('/expense-category/status/{id}','statusUpdate')->name('category.status');
  Route::post('/expense-category/update/{id}','updateCategory')->name('category.update');
  Route::get('/expense/add','addExpense')->name('expense.add');
  Route::post('/expense/store','storeExpense')->name('expense.store');
  Route::get('/expense-list','expenseIndex')->name('expense.index');
  Route::get('/expense/all','getAllExpense')->name('expense.all');
  Route::get('/edit-expense/{id}','editExpense')->name('expense.edit');
  Route::post('/update-expense/{id}','updateExpense')->name('expense.update');
  Route::delete('/delete-expense/{id}','deleteExpense')->name('expense.delete');
  Route::get('/balance-sheet','balanceSheet')->name('balance.sheet');
  Route::get('/filter-balance-sheet','filterBalanceSheet')->name('filter.balance.sheet');
  Route::get('/expese-print','print');
  Route::get('/single/event/report','singleEventReport')->name('single.report.event');
  Route::get('/single/event/history','filterSingleEvent')->name('single.report.history');
  Route::get('/all-event-report','eventReport')->name('report.event');
  Route::get('/report/filter','filterEventReport')->name('report.filter');
  Route::get('/filter-single-event','filterSingleEventDatewise')->name('filter-single-event');
    Route::get('/report/daily-ledger','daily_ledger')->name('report.daily.ledger');
  Route::get('/report/filter-daily-ledger','filter_daily_ledger')->name('report.filter.daily.ledger');

  //Income Routes

  Route::get('/income/add','incomeAddView')->name('income.add');
  Route::post('/income/store','storeIncomeData')->name('income.store');
  Route::get('/income-list','incomeIndex')->name('income.index');
  Route::get('/income/all','getAllIncome')->name('income.all');
  Route::get('/edit-income/{id}','incomeEdit')->name('income.edit');
  Route::post('/update-income/{id}','incomeUpdate')->name('income.update');
  Route::delete('/delete-income/{id}','deleteIncomeData')->name('income.delete');
  Route::get('/income-print','incomePrint');
  Route::get('/income-status/{id}','incomestatusUpdate')->name('income.status');




  // Route::get('/delete/{id}','deleteDistrict')->name('district.delete');
});

Route::get('/event-expense/{id}',[EventExpenseController::class,'eventExpense'])->name('event-expense');
Route::post('/store-expense',[EventExpenseController::class,'storeEventExpenses'])->name('store-expense');


  //User Route
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('user');
        Route::get('/create', 'createUser')->name('user.create');
        Route::post('/create', 'storeUser')->name('user.store');
        Route::get('/getUser', 'allUser')->name('user.getUser');
        // Route::get('/profile', 'profile')->name('user.profile');
        Route::get('/edit/{id}', 'editUser')->name('user.editUser');
        Route::post('/edit/{id}', 'updateUser')->name('user.update');
        Route::get('/status/{id}', 'statusUpdate')->name('user.status');
        Route::get('/delete/{id}', 'deleteUser')->name('user.delete');
    });

  //Role Route

  Route::controller(RoleController::class)->group(function () {
    Route::get('roles', 'index')->name('role');
    Route::post('roles/create', 'storeRole')->name('role.create');
    Route::get('roles/edit/{id}', 'editRole')->name('role.edit');
    Route::post('roles/edit/{id}', 'updateRole')->name('role.update');
    Route::get('roles/delete/{id}', 'deleteRole')->name('role.delete');
});

  Route::controller(StuffController::class)->group(function () {
    Route::get('stuffs', 'index')->name('stuff');
    Route::get('stuffs/edit/{id}', 'edit')->name('stuff.edit');
    Route::post('stuffs/edit/{id}', 'update');
    Route::get('stuffs/delete/{id}', 'edit')->name('stuff.delete');
  });

    Route::get('/sms',[SendsmsController::class,'sendSms'])->name('sms');
    Route::get('/sms/all',[SendsmsController::class,'getAllsms'])->name('sms.all');
  Route::post('/sms-store',[SendsmsController::class,'storeSms'])->name('store-sms');
    Route::post('/sms-store',[SendsmsController::class,'storeSms'])->name('store-sms');
  Route::get('/sms-delete/{id}',[SendsmsController::class,'delete'])->name('sms-delete');

// });

//================ Clear Website Cache ==================//
Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');

    Toastr::success("Cache cleard successfully");

    return redirect()->back();
});

//================ StaffPanelController Start ==================//
Route::controller(StaffPanelController::class)->group(function () {
  Route::get('events', 'events')->name('stuff.event');
  Route::get('getEvent', 'getStaffEvent')->name('stuff.event.all');
  Route::get('payment', 'paymentHistory')->name('stuff.payment');
  Route::get('getPayments', 'getPaymentInfo')->name('stuff.payment.all');
  Route::get('payment-log', 'getPaymentHistory')->name('payment-log');
Route::post('photographer-experience', 'shareExperience')->name('photographer.experience');

  // Route::get('stuffs/delete/{id}', 'edit')->name('stuff.delete');
});

//================ StaffPanelController End ==================//

