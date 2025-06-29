<?php

namespace App\Http\Controllers\BackEnd;

use Carbon\Carbon;
use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\BackEnd\Expense;
use App\Models\BackEnd\Paymentlog;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\EventDetails;
use App\Models\BackEnd\PayMentModel;
use App\Models\BackEnd\StaffPayment;
use App\Models\BackEnd\Expensecategory;
use Illuminate\Support\Facades\Session;
use App\Models\BackEnd\EventwisePayment;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use DB;

class AccountController extends Controller
{
    public function categoryindex(){
         if (!check_access("account.category.list")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
        $categories = Expensecategory::paginate(10);
        return view('BackEnd.account.manage_expense_category',compact('categories'));   
    }

   public function storeCategory(Request $request){
        $data = [
            'name' => $request->category_name,
            'type' => $request->type,
        ];
        Expensecategory::create($data);
        Toastr::success('Category Created Successfully');
        return redirect()->back();
    }

    public function updateCategory(Request $request,$id){
        $category = Expensecategory::find($id);
        $data = [
            'name' => $request->category_name,
            'type' => $request->type,
        ];
        $category ->update($data);
        Toastr::success('Category Updated Successfully');
        return redirect()->back();
    }

    public function statusUpdate($id)
    {
        try {
            if (!check_access("account.category.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = Expensecategory::find($id);
            if ($status->status == 1) {
                $status->status = 0;
                Toastr::warning("Status Inactive !");
            } else {
                $status->status = 1;
                Toastr::success("Status Activated !");
            }
            $status->save();

            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
//=================== Expense Related Functions ==============//

    public function expenseIndex(){
        if (!check_access("expense.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $events = EventDetails::all();
        $expenseCategory = Expensecategory::where('type','Expense')->get();
        return view('BackEnd.account.manage_expense',compact('expenseCategory'));
    }

     public function addExpense(){
        if (!check_access("expense.add")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }

        $categories = Expensecategory::where('type','Expense')->get();

        return view('BackEnd.account.expense_add',compact('categories'));   

    }

    public function storeExpense(Request $request){

        $validators = Validator::make($request->all(), [
            'category_id'          => 'required',
            'remarks'              => 'required',
            'amount'               => 'required',
            'date'                 => 'required',
            'payment_type'         => 'required',
        ]);

        if ($validators->fails()) {
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        if ($request->hasFile('document')) {
            $file            = $request->file('document');
            $file_enc_name   = rand(0, 10) . time() . md5($file->getClientOriginalName());
            $file_extension  = $file->getClientOriginalExtension();
            $file_name       = $file_enc_name . "." . $file_extension;

            $destination_path = "backend/expense/";
            $file->move($destination_path, $file_name);
        } else {
            $file_name = "";
        }

        $expense = Expense::latest()->first();

        $invoice = "EXP-01";

        if($expense){
            $invoice = "EXP-0".$expense->id + 1;
        }

        $data = [
            'invoice_no'        =>$invoice,
            'category_id'       => $request->category_id,
            'expense_type'      => $request->expense_type,
            'remarks'           => $request->remarks,
            'amount'            => $request->amount,
            'date'              => $request->date,
            'document'          => $file_name,
            'payment_type'      => $request->payment_type,
            'transaction_id'    => $request->transaction_id,
            'account_no'        => $request->account_no,
        ];

        Expense::create($data);
        Toastr::success("Expense Data Stored Successfully");

        return redirect()->back();
    }
    public function editExpense(Request $request, $id){
        if (!check_access("expense.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $categories = Expensecategory::where('type','Expense')->get();
        $expense = Expense::find($id);
        return view('BackEnd.account.edit_expense',compact('categories','expense'));   

    }

    public function updateExpense(Request $request, $id){

        $validators = Validator::make($request->all(), [
            'category_id'          => 'required',
            'remarks'              => 'required',
            'amount'               => 'required',
            'date'                 => 'required',
            'payment_type'         => 'required',
        ]);

        $expense = Expense::find($id);

        if ($validators->fails()) {
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        if ($request->hasFile('document')) {
            $path = public_path() . "backend/expense/" . $expense->document;
            if (file_exists($path)) {
                unlink($path);
            }
            $file            = $request->file('document');
            $file_enc_name   = $file->getClientOriginalName();
            $file_name       = $file_enc_name;
            $destination_path = "backend/expense/";
            $file->move($destination_path, $file_name);
        } else {
            $file_name = $expense->document;
        }



        $data = [
            'category_id'       => $request->category_id,
            'remarks'           => $request->remarks,
            'expense_type'      => $request->expense_type,
            'amount'            => $request->amount,
            'date'              => $request->date,
            'document'          => $file_name,
            'payment_type'      => $request->payment_type,
            'transaction_id'    => $request->old_transaction_id ? $request->old_transaction_id : $request->transaction_id,
            'account_no'        => $request->old_account_no ? $request->old_account_no : $request->account_no,
        ];

        // dd($data);

        $expense->update($data);
        Toastr::success("Expense Data Updated Successfully");

        return redirect()->back();
    }

    public function getAllExpense(Request $request){

        $query =  Expense::orderByDesc('id');
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $expense_type = $request->expense_type;
        $category_id = $request->category_id;
        // dd($category_id);

        if($from_date != "" && $to_date !=""){
            $query->where('date','>=',$from_date)->where('date','<=',$to_date);
        }

        if($expense_type != ''){
            $query->where('expense_type',$expense_type);

        } 
        if($category_id != ''){
            $query->where('category_id',$category_id);

        }
        $expenses = $query->get();
    // dd($expenses);

        session([
            'expense_type'                  => $expense_type,
            'from_date'                     => $from_date,
            'to_date'                       => $to_date,
            'category_id'                   => $category_id,
            
        ]);
        return DataTables::of($expenses)
        ->addIndexColumn()
        ->setRowId(function ($expense) {
            return $expense->id; })
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('invoice', function ($expense) {
            $invoice = $expense->invoice_no;
            return $invoice;
        })
        ->addColumn('date', function ($expense) {
            $date = date('d/m/Y',strtotime($expense->date));
            return $date;
        })
        ->addColumn('category', function ($expense) {
            $category = $expense->category->name;
            return $category;
        })
        ->addColumn('type', function ($expense) {
            $category = $expense->expense_type;
            return $category;
        })
       ->addColumn('expense_for', function ($expense) {
            $expense_for = '';
           if($expense->event){
                $venueFormatted = wordwrap($expense->event->venue, 50, "<br>");
                $expense_for = $venueFormatted;
           }else{
                $expense_for = "---";
           }
           return $expense_for;
        })
        ->addColumn('remarks', function ($expense) {
            $remarks = $expense->remarks;
            return $remarks;
        })
        ->addColumn('amount', function ($expense) {
            $amount = $expense->amount;
            return $amount;
        })
        ->addColumn('payment_type', function ($expense) {
            $payment_type = $expense->payment_type;
            return $payment_type;
        })
        ->addColumn('transaction_id', function ($expense) {
            $transaction_id = $expense->transaction_id;
            return $transaction_id;
        })
        ->addColumn('account_no', function ($expense) {
            $account_no = $expense->account_no;
            return $account_no;
        })
       
        ->addColumn('document', function ($expense) {
            $document = "";

            if($expense->document != ""){
                $url = asset("backend/expense/" . $expense->document);
                $document = '<a href="' . $url . '" target="_blank" class="btn btn-info">
                        <i class="fa fa-download"></i>
                </a>';
            }
          
            return $document;
        })
       
        ->addColumn('action', function ($expense) {
            $edit  = '';
            $delete  = '';
            if (check_access("expense.edit")) {
                $edit = '<a href="' . route('expense.edit',$expense->id) . '" style="padding:2px; margin-left:3px"
                    class="btn btn-xs btn-primary btn-sm mr-1">
                    <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>';

            }
            if (check_access("expense.delete")){
                $delete = '<a onclick="deleteData(' .$expense->id .')" data-id="' .$expense->id .'"
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

            return  $edit . $delete;
        })


        ->rawColumns(['invoice', 'category', 'date','remarks', 'amount','document','payment_type','transaction_id','account_no','action','expense_for'])
        ->make(true);
    }



    public function deleteExpense($id){
        if (!check_access("expense.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }

    function print(){
        try{
            $expense_data                   = Expense::orderByDesc('date');
            $where = array();
            $data['expense_type']           = $expense_type = Session::get('expense_type');
            $data['from_date']              = $from_date = Session::get('from_date');
            $data['to_date']                = $to_date =Session::get('to_date');
            $data['category_id']                = $to_date =Session::get('category_id');

            if($expense_type){
                $expense_data->where('expense_type',$expense_type);
            }
            if($from_date){
                $expense_data->whereDate('date','>=',$from_date);
            }
            if($to_date){
                $expense_data->whereDate('date','<=',$to_date);
            }

            $expense_data = $expense_data->get();
            // $expense_data->appends($where);
            $data['expense_data']             = $expense_data;
            return view('BackEnd.account.expense_list_print',$data);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    
       //==============================*********** Income Module *********** ========================//


    //==================== Income Index Function start ============//
    public function incomeIndex(){
        if (!check_access("income.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        // $incomes = Income::all();
        $categories = Expensecategory::where('type','Income')->get();
        return view('BackEnd.account.manage_income',compact('categories'));
    }
    //==================== Income Index Function End ============//


    //==================== Income Add Function start ============//
    public function incomeAddView(){
        if (!check_access("income.add")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $categories = Expensecategory::where('type','Income')->get();
        return view('BackEnd.account.income_add',compact('categories'));


    }
    //==================== Income Add Function End ============//


    //==================== Income Store Function start ============//
    public function storeIncomeData(Request $request){
        $validators = Validator::make($request->all(), [
            'category_id'          => 'required',
            'remarks'              => 'required',
            'amount'               => 'required',
            'date'                 => 'required',
            'payment_type'         => 'required',
        ]);

        if ($validators->fails()) {
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        if ($request->hasFile('document')) {
            $file            = $request->file('document');
            $file_enc_name   = rand(0, 10) . time() . md5($file->getClientOriginalName());
            $file_extension  = $file->getClientOriginalExtension();
            $file_name       = $file_enc_name . "." . $file_extension;

            $destination_path = "backend/income/";
            $file->move($destination_path, $file_name);
        } else {
            $file_name = "Null";
        }

        $income = Income::latest()->first();

        $invoice = "INV-0001";

        if($income){
            $invoice = "INV-000".$income->id + 1;
        }

        $data = [
            'invoice_no'        => $invoice,
            'category_id'       => $request->category_id,
            'remarks'           => $request->remarks,
            'amount'            => $request->amount,
            'date'              => $request->date,
            'document'          => $file_name,
            'payment_type'      => $request->payment_type,
            'transaction_id'    => $request->transaction_id,
            'account_no'        => $request->account_no,
            'created_by'        => auth()->user()->id,
            'status'            => $request->status,
        ];

        Income::create($data);
        Toastr::success("Income Data Stored Successfully");

        return redirect()->route('income.index');
    }

    //==================== Income Store Function End ============//

    
    //==================== Income Edit Function start ============//
    public function incomeEdit(Request $request,$id){
        if (!check_access("income.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
       $income = Income::findOrFail($id);
       $categories = Expensecategory::where('type','Income')->get();
       return view('BackEnd.account.income_edit',compact('categories','income'));
    }
    //==================== Income Edit Function start ============//


    //==================== Income Update Function start ============//
    public function incomeUpdate(Request $request,$id){
        $validators = Validator::make($request->all(), [
            'category_id'          => 'required',
            'remarks'              => 'required',
            'amount'               => 'required',
            'date'                 => 'required',
            'payment_type'         => 'required',
        ]);

        if ($validators->fails()) {
            Toastr::error("Invalid Data given!");
            return redirect()->back();
        }

        $income = Income::find($id);

        if ($request->hasFile('document')) {
            $path = public_path() . "backend/income/" . $income->document;
            if (file_exists($path)) {
                unlink($path);
            }
            $file            = $request->file('document');
            $file_enc_name   = $file->getClientOriginalName();
            $file_name       = $file_enc_name;
            $destination_path = "backend/income/";
            $file->move($destination_path, $file_name);
        } else {
            $file_name = $income->document;
        }

        $data = [
            'category_id'       => $request->category_id,
            'remarks'           => $request->remarks,
            'amount'            => $request->amount,
            'date'              => $request->date,
            'document'          => $file_name,
            'payment_type'      => $request->payment_type,
            'transaction_id'    => $request->transaction_id,
            'account_no'        => $request->account_no,
            'modified_by'       => auth()->user()->id,
        ];

        $income->update($data);
        
        Toastr::success("Income Data Updated Successfully");

        return redirect()->back();
    }

    //==================== Income Update Function End ============//


    //==================== Income List Print start ============//
    public function incomePrint(){
        
    }

    //==================== Income List Print Function End ============//

    //==================== Income Delete Function start ============//
    public function deleteIncomeData($id){
        $income = Income::findOrFail($id);
        $income->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
    //==================== Income Delete Function Function End ============//



    //==================== Get All Incomes Using Datatable ============//
    public function getAllIncome(Request $request){
        $query = Income::orderByDesc('id');
        $category_id = $request->category_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;



        if($category_id != ""){
            $query->where('category_id',$category_id);
        }

        if($from_date != "" && $to_date !=""){
            $query->where('date','>=',$from_date)->where('date','<=',$to_date);
        }

        $incomes = $query->get();

        session([
            'category_id'                   => $category_id,
            'from_date'                     => $from_date,
            'to_date'                       => $to_date,
        ]);


        return DataTables::of($incomes)
        ->addIndexColumn()
        ->setRowId(function ($income) {
            return $income->id; })
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('invoice', function ($income) {
            $invoice = $income->invoice_no;
            return $invoice;
        })
        ->addColumn('date', function ($income) {
            $date = date('d/m/Y',strtotime($income->date));
            return $date;
        })
        ->addColumn('category', function ($income) {
            $category = $income->category->name;
            return $category;
        })
        ->addColumn('remarks', function ($income) {
            $remarks = $income->remarks;
            return $remarks;
        })
        ->addColumn('amount', function ($income) {
            $amount = $income->amount;
            return $amount;
        })
        ->addColumn('payment_type', function ($income) {
            $payment_type = $income->payment_type;
            return $payment_type;
        })
        ->addColumn('transaction_id', function ($income) {
            $transaction_id = $income->transaction_id;
            return $transaction_id;
        })
        ->addColumn('account_no', function ($income) {
            $account_no = $income->account_no;
            return $account_no;
        })
       
        ->addColumn('document', function ($income) {
            $document = "";

            if($income->document != "Null"){
                $url = asset("backend/income/" . $income->document);
                $document = '<a href="' . $url . '" target="_blank" class="btn btn-info">
                        <i class="fa fa-download"></i>
                </a>';
            }
          
            return $document;
        })
       
        ->addColumn('action', function ($income) {
            $edit  = '';
            $delete  = '';
            if (check_access("income.edit")) {
                $edit = '<a href="' . route('income.edit',$income->id) . '" style="padding:2px; margin-left:3px"
                    class="btn btn-xs btn-primary btn-sm mr-1">
                    <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>';
                
                $status = '<a href="' . route('income.status', $income->id) . '" style="padding:2px; margin-left:3px"
                            class="btn btn-xs btn-' . ($income->status == '1' ? 'success' : 'warning') . ' btn-sm mr-1">
                            <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-' . ($income->status == '1' ? 'arrow-up' : 'arrow-down') . '">
                                ' . ($income->status == '1' ? '<line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline>' : '<line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline>') . '
                            </svg> 
                        </a>';

            }
            if (check_access("income.delete")){
                $delete = '<a onclick="deleteData(' .$income->id .')" data-id="' .$income->id .'"
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

            return  $edit.$status . $delete;
        })


        ->rawColumns(['invoice', 'category', 'date','remarks', 'amount','document','payment_type','transaction_id','account_no','action'])
        ->make(true);
                
    }
    
  public function incomestatusUpdate($id){
        try{
            if (!check_access("income.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = Income::find($id);
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


    //==================== Income List End ============//

    

    //============================== Balance Sheet ========================//


//   public function balanceSheet(){
//             if (!check_access("balance.sheet")) {
//                 Toastr::error("You don't have permission!");
//                 return redirect()->route('admin.index');
//             }

//             $currentMonth = Carbon::now()->month;
//             $currentYear  = Carbon::now()->year;


//             $client_payments  = Paymentlog::whereMonth('payment_date', $currentMonth)
//                                             ->whereYear('payment_date', $currentYear)
//                                             ->orderByDesc('id')
//                                             ->get();

//             $client_payment   = Paymentlog::whereMonth('payment_date', $currentMonth)
//                                 ->whereYear('payment_date', $currentYear)
//                                 ->orderByDesc('id')
//                                 ->sum('amount');

//             $staff_payments   = StaffPayment::whereMonth('payment_date', $currentMonth)
//                                         ->whereYear('payment_date', $currentYear)
//                                         ->orderByDesc('id')
//                                         ->get();

//             $staff_payment    = StaffPayment::whereMonth('payment_date', $currentMonth)
//                                         ->whereYear('payment_date', $currentYear)
//                                         ->orderByDesc('id')
//                                         ->sum('paid');


//             $expenses         =  Expense::whereMonth('date', $currentMonth)
//                                 ->whereYear('date', $currentYear)
//                                 ->whereNull('event_id')
//                                 ->orderByDesc('id')
//                                 ->get();

//             $expense         =  Expense::whereMonth('date', $currentMonth)
//                                 ->whereYear('date', $currentYear)
//                                 ->whereNull('event_id')
//                                 ->orderByDesc('id')
//                                 ->sum('amount');
                                

//             $currentMonthFirstDate = Carbon::now()->startOfMonth();
//             $previousMonth = $currentMonth - 1;
//             $previousYear = $currentYear;

//             if ($previousMonth == 0) {
//                 $previousMonth = 12;
//                 $previousYear--;
//             }

//             $monthname = Carbon::now()->format('F');

//             $previousMonthClosingBalance = 0;


//             $prev_month_client_payment = Paymentlog::whereMonth('payment_date', $previousMonth)
//                                         ->whereYear('payment_date', $previousYear)
//                                         ->orderByDesc('id')
//                                         ->sum('amount');
            
//             $prev_month_staff_payment = StaffPayment::whereMonth('payment_date', $previousMonth)
//                                         ->whereYear('payment_date', $previousYear)
//                                         ->orderByDesc('id')
//                                         ->sum('paid');

//             $prev_month_expense       = Expense::whereMonth('date', $previousMonth)
//                                         ->whereYear('date', $previousYear)
//                                         ->whereNull('event_id')
//                                         ->orderByDesc('id')
//                                         ->sum('amount');


            
//             $previousMonthClosingBalance = $prev_month_client_payment - ($prev_month_staff_payment + $prev_month_expense);

//             // $previousMonthClosingBalance = Transaction::whereYear('transaction_date', $previousYear)
//             //         ->whereMonth('transaction_date', $previousMonth)
//             //         ->sum('amount');

//           $currentMonthOpeningBalance = $previousMonthClosingBalance;

           
//           $total_income = $currentMonthOpeningBalance + $client_payment;
//           $total_expense = $staff_payment + $expense;

//           $profit = $total_income -  $total_expense;


//       return view('BackEnd.account.balance_sheet',compact('client_payment','client_payments','staff_payments','total_expense','expenses','profit','currentMonthOpeningBalance',
//                     'currentMonth','currentYear','monthname','currentMonthFirstDate')); 
//     }

   
//     public function filterBalanceSheet(Request $request){
//         $payment_type           = $request->payment_type;
//         $from_date              = $request->start_date;
//         $end_date               = $request->end_date;
//         $date                   = Carbon::parse($end_date);
//         $first_date             = $date->copy()->startOfMonth();
//         $currentYear            = $date->year;
//         $last_month             = $date->subMonth()->month;
//         $last_year              = $date->subYear()->year;

//         $last_year = $currentYear;
      
//         if ($last_month == 0) {
//             $last_month = 12;
//             $last_year--;
//         }

//         $previousMonthClosingBalance = 0;


//         $prev_month_client_payment = Paymentlog::whereMonth('payment_date', $last_month)
//                                     ->whereYear('payment_date', $last_year)
//                                     ->where('payment_method',$payment_type)
//                                     ->orderByDesc('id')
//                                     ->sum('amount');
        
//         $prev_month_staff_payment = StaffPayment::whereMonth('payment_date', $last_month)
//                                     ->whereYear('payment_date', $last_year)
//                                     ->where('payment_system',$payment_type)
//                                     ->orderByDesc('id')
//                                     ->sum('paid');

//         $prev_month_expense       = Expense::whereMonth('date', $last_month)
//                                     ->whereNull('event_id')
//                                     ->whereYear('date', $last_year)
//                                     ->where('payment_type',$payment_type)
//                                     ->orderByDesc('id')
//                                     ->sum('amount');


//         $previousMonthClosingBalance = $prev_month_client_payment - ($prev_month_staff_payment + $prev_month_expense);

//         $client_payment       = Paymentlog::where('payment_date','>=',$from_date)->where('payment_date','<=',$end_date)->where('payment_method',$payment_type)->orderByDesc('id')->get();
//         $staff_payment        = StaffPayment::where('payment_date','>=',$from_date)->where('payment_date','<=',$end_date)->where('payment_system',$payment_type)->orderByDesc('id')->get();
//         $expense              = Expense::where('date','>=',$from_date)->where('date','<=',$end_date)->whereNull('event_id')->where('payment_type',$payment_type)->orderByDesc('id')->get();



//       return view('BackEnd.account.filter_balance_sheet',compact('client_payment','staff_payment','expense','from_date','end_date'
//       ,'previousMonthClosingBalance','first_date')); 
//     }


//====================   Balancesheet Function Start  ============//

    public function balanceSheet(){
            if (!check_access("balance.sheet")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }

            $currentMonth = Carbon::now()->month;
            $currentYear  = Carbon::now()->year;


            $income       = Income::whereMonth('date', $currentMonth)
                                ->whereYear('date', $currentYear)
                                ->orderByDesc('id')
                                ->where('status',1)
                                ->sum('amount');

            $incomes    = Income::whereMonth('date', $currentMonth)
                                ->whereYear('date', $currentYear)
                                ->orderByDesc('id')
                                ->where('status',1)
                                ->get();


            $expenses   =  Expense::whereMonth('date', $currentMonth)
                                ->whereYear('date', $currentYear)
                                ->whereNull('event_id')
                                ->whereIn('expense_type',['Variable','Office Expense'])
                                ->orderByDesc('id')
                                ->get();

            $expense    =  Expense::whereMonth('date', $currentMonth)
                                ->whereYear('date', $currentYear)
                                ->whereNull('event_id')
                                ->whereIn('expense_type',['Variable','Office Expense'])
                                ->orderByDesc('id')
                                ->sum('amount');
                                

            $currentMonthFirstDate = Carbon::now()->startOfMonth();
            $previousMonth = $currentMonth - 1;
            $previousYear = $currentYear;

            if ($previousMonth == 0) {
                $previousMonth = 12;
                $previousYear--;
            }

            $monthname = Carbon::now()->format('F');

            $previousMonthClosingBalance = 0;


            $prev_month_income      = Income::whereMonth('date', $previousMonth)
                                    ->whereYear('date', $previousYear)
                                    ->orderByDesc('id')
                                    ->where('status',1)
                                    ->sum('amount');

            // dd($prev_month_income);

            $prev_month_expense       = Expense::whereMonth('date', $previousMonth)
                                        ->whereYear('date', $previousYear)
                                        ->whereIn('expense_type',['Variable','Office Expense'])
                                        ->whereNull('event_id')
                                        ->orderByDesc('id')
                                        ->sum('amount');

        
            
            $previousMonthClosingBalance = $prev_month_income - $prev_month_expense;

            // $previousMonthClosingBalance = Transaction::whereYear('transaction_date', $previousYear)
            //         ->whereMonth('transaction_date', $previousMonth)
            //         ->sum('amount');

           $currentMonthOpeningBalance = $previousMonthClosingBalance;

           
           $total_income = $currentMonthOpeningBalance + $income;
           $total_expense = $expense;

           $profit = $total_income -  $total_expense;


       return view('BackEnd.account.balance_sheet',compact('incomes','total_expense','expenses','profit','currentMonthOpeningBalance',
                    'currentMonth','currentYear','monthname','currentMonthFirstDate')); 
    }

    //====================   Balancesheet Function End  ============//


    //====================  Filter Balancesheet Function Start  ============//

    public function filterBalanceSheet(Request $request){
        $payment_type           = $request->payment_type;
        $from_date              = $request->start_date;
        $end_date               = $request->end_date;
        $date                   = Carbon::parse($from_date);
        $first_date             = $date->copy()->startOfMonth();
        $currentYear            = $date->year;
        $last_month             = $date->subMonth()->month;
        $last_year              = $date->subYear()->year;

        $last_year = $currentYear;
      
        if ($last_month == 0) {
            $last_month = 12;
            $last_year--;
        }

        $previousMonthClosingBalance = 0;

        $prev_month_income      = Income::whereMonth('date', $last_month)
                                    ->whereYear('date', $last_year)
                                    ->orderByDesc('id')
                                    ->where('status',1)
                                    ->sum('amount');


        $prev_month_expense     = Expense::whereMonth('date', $last_month)
                                    ->whereNull('event_id')
                                    ->whereYear('date', $last_year)
                                    ->where('payment_type',$payment_type)
                                    ->whereIn('expense_type',['Variable','Office Expense'])
                                    ->orderByDesc('id')
                                    ->sum('amount');


        $previousMonthClosingBalance = $prev_month_income -  $prev_month_expense;

        $expense              = Expense::where('date','>=',$from_date)->where('date','<=',$end_date)->whereIn('expense_type',['Variable','Office Expense'])->whereNull('event_id')->orderByDesc('id')->get();
        $income               = Income::where('date','>=',$from_date)->where('date','<=',$end_date)->orderByDesc('id')->where('status',1)->get();



       return view('BackEnd.account.filter_balance_sheet',compact('income','expense','from_date','end_date'
       ,'previousMonthClosingBalance','first_date')); 
    }

    //====================  Filter Balancesheet Function End  ============//


    public function singleEventReport(){
        $currentMonth          = Carbon::now()->month;
        $currentYear           = Carbon::now()->year;
        $monthname             = Carbon::now()->format('F');
        $eventDetails          = EventDetails::get();

        return view('BackEnd.account.single_event_report',compact('monthname','currentYear','eventDetails'));

    }

  


    public function eventReport(){
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $monthname = Carbon::now()->format('F');

        // $events = EventDetails::whereYear('date', now()->year)
        //                       ->orderBy('date', 'asc')
        //                       ->get();
        $total_income    = 0;
        $total_expense   = 0;
        // dd($currentYear);
        $fixed_expense = Expense::whereMonth('date',$currentMonth)->whereYear('date',$currentYear)->whereIn('expense_type',['Fixed','Office Expense'])->sum('amount');
        // dd($fixed_expense);
        
        $events = EventDetails::whereMonth('date', $currentMonth)
                      ->whereYear('date', $currentYear)
                      ->where('status','<>',2)
                      ->orderBy('date','asc')
                      ->get();
        // dd($events);
        $total_event_price = 0;
        foreach($events as $v_event){
        //   $total_event_price +=  $v_event->package_price ? $v_event->package_price : $v_event->package->discount ; 
            $master_event_id = $v_event->event->id;
            $master_event_count = EventDetails::where('master_id', $master_event_id)->count(); 
            if ($master_event_count == 1) {
                // Use the payment_amount from the master_event
                $total_event_price += $v_event->event->payment ? $v_event->event->payment->payment_amount : 0 ;
            } else {
                // Use package_price or discount
                $total_event_price += $v_event->package_price 
                    ? $v_event->package_price 
                    : $v_event->package->discount;
            }
        }
        // dd($total_event_price);
        if($fixed_expense > 0 ){
            $per_event_expense = (int) $fixed_expense / $total_event_price;
           
        }else{
            $per_event_expense = 0;
        }
        // dd($per_event_expense);
        return view('BackEnd.account.event_ledger',compact('fixed_expense','events','total_event_price','per_event_expense','monthname','currentYear')); 

    }
    
    public function filterEventReport(Request $request)
{
    $start_date = $request->start_date;
    $end_date = $request->end_date;

    $currentMonth = Carbon::parse($start_date)->month;
    $currentYear = Carbon::parse($start_date)->year;
    $monthname = Carbon::parse($start_date)->format('F');

    $fixed_expense_monthwise = [];
    $event_expense_monthwise = [];

    // Calculate month-wise fixed expenses
    $expenses = Expense::whereBetween('date', [$start_date, $end_date])
        ->whereIn('expense_type', ['Fixed', 'Office Expense'])
        ->selectRaw('DATE_FORMAT(date, "%m/%Y") as month, SUM(amount) as total')
        ->groupBy('month')
        ->get();
        
        // dd($expenses);

    foreach ($expenses as $expense) {
        $fixed_expense_monthwise[$expense->month] = $expense->total;
    }
    

    // Retrieve events for the given date range
$events = EventDetails::whereBetween('date', [$start_date, $end_date])
    ->selectRaw('
        DATE_FORMAT(date, "%m/%Y") as month,
        SUM(
            CASE 
                WHEN (
                    SELECT COUNT(*) 
                    FROM event_details ed 
                    WHERE ed.master_id = event_masters.id
                ) = 1 THEN COALESCE(payments.payment_amount, 0)
                ELSE COALESCE(event_details.package_price, packages.discount)
            END
        ) as total_event_price
    ')
    ->leftJoin('packages', 'event_details.package_id', '=', 'packages.id') 
    ->leftJoin('event_masters', 'event_details.master_id', '=', 'event_masters.id')
    ->leftJoin('payments', 'payments.event_id', '=', 'event_masters.id')
    ->groupBy(DB::raw('DATE_FORMAT(date, "%m/%Y")'))
    ->get();

// Output the result for debugging
// dd($events);
    
    $total_event_price_monthwise = [];
    

    foreach ($events as $event) {
          
        $total_event_price_monthwise[$event->month] = $event->total_event_price;

    }
    // dd($total_event_price_monthwise);

    // Retrieve individual events for the given date range
    $individual_events = EventDetails::whereBetween('date', [$start_date, $end_date])
        ->where('event_details.status', '<>', 2)
        ->selectRaw('
            DATE_FORMAT(date, "%m/%Y") as month,
            event_details.id,
            event_details.master_id,
            event_details.venue,
            package_price,
            packages.discount,
            booking_id,
            event_details.date,
            payments.payment_amount
        ')
        ->leftJoin('packages', 'event_details.package_id', '=', 'packages.id')
        ->leftJoin('event_masters', 'event_details.master_id', '=', 'event_masters.id')
        ->leftJoin('payments', 'payments.event_id', '=', 'event_masters.id')
        ->orderBy('event_details.date', 'asc')
        ->get();
        
// dd($individual_events);
    foreach ($individual_events as $event) {
        $month = $event->month;
        $event_id = $event->id;
        $booking_id = $event->booking_id;
        $event_date = $event->date;
        $event_name = $event->venue;
        $event_price = $event->package_price ?? $event->discount;
        $event_discount = $event->discount;

        // Calculate the total event price for the month
        $master_event_count = EventDetails::where('master_id', $event->master_id)->count();
        $total_event_price = ($master_event_count === 1) 
            ? $event->payment_amount 
            : $event_price;

        if (isset($fixed_expense_monthwise[$month]) && isset($total_event_price_monthwise[$month])) {
            $fixed_expense = $fixed_expense_monthwise[$month];
            $total_event_price_month = $total_event_price_monthwise[$month];

            $per_event_expense = ($fixed_expense / $total_event_price_month) * $total_event_price;

            $event_expense_monthwise[$month][] = [
                'event_id' => $event_id,
                'event_name' => $event_name,
                'event_price' => $total_event_price,
                'booking_id' => $booking_id,
                'event_date' => $event_date,
                'event_discount' => $event_discount,
                'per_event_expense' => $per_event_expense
            ];
        }
    }
    // dd($event_expense_monthwise);
    

    return view('BackEnd.account.filter_event_report_by_date', compact(
        'fixed_expense_monthwise',
        'event_expense_monthwise',
        'monthname',
        'currentYear',
        'start_date',
        'end_date'
    ));
}
    
    //  public function filterEventReport(Request $request){
    //     $start_date    = $request->start_date;
    //     $end_date      = $request->end_date;

    //     $currentMonth  = Carbon::parse($start_date)->month;
    //     $currentYear   = Carbon::parse($start_date)->year;
    //     $monthname     = Carbon::parse($start_date)->format('F');
    //     $events        = EventDetails::get();

    //     $total_income    = 0;
    //     $total_expense   = 0;
    //     $fixed_expense = Expense::whereBetween('date', [$start_date, $end_date])->whereMonth('date',$currentMonth)->whereYear('date',$currentYear)->where('expense_type','Fixed')->sum('amount');
    //     $events        = EventDetails::whereBetween('date', [$start_date, $end_date])->whereMonth('date',$currentMonth)->whereYear('date',$currentYear)->orderByDesc('date')->get();
    //     $total_event_price = 0;
    //      foreach($events as $v_event){
    //       $total_event_price += $v_event->package_price ?$v_event->package_price : $v_event->package->discount ; 
    //     }

    //     if($fixed_expense > 0 ){
    //         $per_event_expense = (int) $fixed_expense / $total_event_price;
           
    //     }else{
    //         $per_event_expense = 0;
    //     }
    //     return view('BackEnd.account.filter_event_report_by_date',compact('fixed_expense','events','total_event_price','per_event_expense',
    //     'monthname','currentYear','start_date','end_date')); 
    // }


//     public function filterEventReport(Request $request){
//         $start_date    = $request->start_date;
//         $end_date      = $request->end_date;
//         $currentMonth  = Carbon::parse($start_date)->month;
//         $currentYear   = Carbon::parse($start_date)->year;
//         $monthname     = Carbon::parse($start_date)->format('F');
//         // $months        = $start_date->diffInMonths($end_date);
//         $fixed_expense_monthwise = [];
//         $event_expense_monthwise = [];


//         // Calculate month-wise fixed expenses
//     //       $expenses = Expense::whereBetween('date', [$start_date, $end_date])
//     //         ->whereIn('expense_type',['Fixed','Office Expense'])
//     //         ->selectRaw('DATE_FORMAT(date, "%m/%Y") as month, SUM(amount) as total')
//     //         ->groupBy('month')
//     //         ->get();

//     //     foreach ($expenses as $expense) {
//     //         $fixed_expense_monthwise[$expense->month] = $expense->total;
//     //     }
        
//     //     // dd($fixed_expense_monthwise);

//     //     // Retrieve events and calculate total event price per month
//     //   $events = EventDetails::whereBetween('date', [$start_date, $end_date])
//     //             ->selectRaw('DATE_FORMAT(date, "%m/%Y") as month,SUM(CASE WHEN event_details.status <> 2 THEN COALESCE(package_price, packages.discount) ELSE 0 END) as total_event_price')
//     //             ->leftJoin('packages', 'event_details.package_id', '=', 'packages.id') // Assuming the relationship is with a table called 'packages'
//     //             ->groupBy(DB::raw('DATE_FORMAT(date, "%m/%Y")'))
//     //             ->get();
                
//     //     $total_event_price_monthwise = [];
        
//     //     foreach ($events as $event) {
//     //         $total_event_price_monthwise[$event->month] = $event->total_event_price;
//     //     }
        
//     //     // dd($total_event_price_monthwise);

        
//     //     $individual_events = EventDetails::whereBetween('date', [$start_date, $end_date])
//     //                         ->where('event_details.status', '<>', 2)
//     //                         ->selectRaw('DATE_FORMAT(date, "%m/%Y") as month, event_details.id, event_details.venue, package_price, packages.discount,booking_id,event_details.date')
//     //                         ->leftJoin('packages', 'event_details.package_id', '=', 'packages.id') 
//     //                         ->leftJoin('event_masters', 'event_details.master_id', '=', 'event_masters.id')
//     //                         ->get();
                            

//     //     // Calculate the per-event expense
//     //     foreach ($individual_events as $event) {
//     //         $month = $event->month;
//     //         $event_id = $event->id;
//     //         $booking_id = $event->booking_id;
//     //         $event_date = $event->date;
//     //         $event_name = $event->venue;
//     //         $event_price = $event->package_price ? $event->package_price : $event->discount; 
//     //         $event_discount =  $event->discount; 

//     //         if (isset($fixed_expense_monthwise[$month]) && isset($total_event_price_monthwise[$month])) {
//     //             $fixed_expense = $fixed_expense_monthwise[$month];
//     //             $total_event_price = $total_event_price_monthwise[$month];
//     //             $per_event_expense = ($event_price / $total_event_price) * $fixed_expense;
        
//     //             // Append the per-event expense details to the month
//     //             if (!isset($event_expense_monthwise[$month])) {
//     //                 $event_expense_monthwise[$month] = [];
//     //             }
//     //             $event_expense_monthwise[$month][] = [
//     //                 'event_id' => $event_id,
//     //                 'event_name' => $event_name,
//     //                 'event_price' => $event_price,
//     //                 'booking_id' => $booking_id,
//     //                 'event_date' => $event_date,
//     //                 'event_discount' => $event_discount,
//     //                 'per_event_expense' => $per_event_expense
//     //             ];
//     //         }
//     //     }
//     $expenses = Expense::whereMonth('date', $currentMonth)
//     ->whereIn('expense_type', ['Fixed', 'Office Expense'])
//     ->selectRaw('DATE_FORMAT(date, "%m/%Y") as month, SUM(amount) as total')
//     ->groupBy('month')
//     ->get();

// $fixed_expense_monthwise = [];
// foreach ($expenses as $expense) {
//     $fixed_expense_monthwise[$expense->month] = $expense->total;
// }

// // Retrieve events for the given date range
// $events = EventDetails::whereBetween('date', [$start_date, $end_date])
//     ->selectRaw('
//         DATE_FORMAT(date, "%m/%Y") as month,
//         SUM(CASE 
//             WHEN event_details.status <> 2 
//             THEN COALESCE(package_price, packages.discount) 
//             ELSE 0 
//         END) as total_event_price
//     ')
//     ->leftJoin('packages', 'event_details.package_id', '=', 'packages.id')
//     ->groupBy(DB::raw('DATE_FORMAT(date, "%m/%Y")'))
//     ->get();

// // Initialize total event price per month
// $total_event_price_monthwise = [];
// foreach ($events as $event) {
//     $total_event_price_monthwise[$event->month] = $event->total_event_price;
// }

// // Retrieve individual events for the given date range
// $individual_events = EventDetails::with('event')->whereMonth('date', [$start_date, $end_date])
//     ->where('event_details.status', '<>', 2)
//     ->selectRaw('
//         DATE_FORMAT(date, "%m/%Y") as month, 
//         event_details.id, 
//         event_details.master_id, 
//         event_details.venue, 
//         package_price, 
//         packages.discount,
//         booking_id, 
//         event_details.date,
//         payments.payment_amount
//     ')
//     ->leftJoin('packages', 'event_details.package_id', '=', 'packages.id') 
//     ->leftJoin('event_masters', 'event_details.master_id', '=', 'event_masters.id')
//     ->leftJoin('payments', 'payments.event_id', '=', 'event_masters.id') 
//     ->orderBy('event_details.date','asc')
//     ->get();
//     //  dd($individual_events);

// // Calculate per-event expense based on total event price and fixed expenses
// $event_expense_monthwise = [];
// foreach ($individual_events as $event) {
//     $month = $event->month;
//     $event_id = $event->id;
//     $booking_id = $event->booking_id;
//     $event_date = $event->date;
//     $event_name = $event->venue;
//     $event_price = $event->package_price ? $event->package_price : $event->discount; 
//     $event_discount =  $event->discount; 

//     // Calculate the total event price for the month based on master event condition
//     $total_event_price = 0;
//     $master_event_id = $event->master_id;
//     // dd($master_event_id);
//     $master_event_count = EventDetails::where('master_id', $master_event_id)->count(); 

//     if ($master_event_count == 1) {
//         // dd('sdfdf');
//         // Use the payment_amount from the master_event
//         $total_event_price = $event->payment_amount;
//     } else {
//         // Use package_price or discount
//         $total_event_price = $event_price;
//     }
//     // dd($event_price);

//     // Check if both fixed expense and total event price are available for the month
//     if (isset($fixed_expense_monthwise[$month]) && isset($total_event_price_monthwise[$month])) {
//         $fixed_expense = $fixed_expense_monthwise[$month];
//         $total_event_price_month = $total_event_price_monthwise[$month];

//         // Calculate per-event expense
//         $per_event_expense = ($event_price / $total_event_price_month) * $fixed_expense;
        
//         // Store the per-event expense details
//         if (!isset($event_expense_monthwise[$month])) {
//             $event_expense_monthwise[$month] = [];
//         }
//         $event_expense_monthwise[$month][] = [
//             'event_id' => $event_id,
//             'event_name' => $event_name,
//             'event_price' => $total_event_price,
//             'booking_id' => $booking_id,
//             'event_date' => $event_date,
//             'event_discount' => $event_discount,
//             'per_event_expense' => $per_event_expense
//         ];
//     }
// }

// // dd($event_expense_monthwise);

        
        
//         return view('BackEnd.account.filter_event_report_by_date',compact('fixed_expense','event_expense_monthwise',
//         'monthname','currentYear','start_date','end_date')); 
//     }



    
    public function filterSingleEventDatewise(Request $request){
        $start_date    = $request->start_date;
        $end_date      = $request->end_date;
        
        $eventDetails          = EventDetails::whereBetween('date', [$start_date, $end_date])->get();
        if (count($eventDetails) > 0) {
            return response()->json($eventDetails);
        }
        
    }
    
    
      public function filterSingleEvent(Request $request){

        // $currentMonth = Carbon::now()->month;
        // $currentYear = Carbon::now()->year;

        $event_id              = $request->event_id;
        $start_date            = $request->start_date;
        $end_date              = $request->end_date;
     
        $event                 = EventDetails::where('id',$event_id)->first();
        $event_name            = $event->venue;
        $event_date            = $event->date;
        $carbonDate            = Carbon::parse($event_date);

        $eventMonth            = $carbonDate->month;
        $eventYear             = $carbonDate->year;
        $staffPayment          = EventwisePayment::where('event_details_id',$event_id)->get();
        $expense               = Expense::where('event_id',$event_id)->get();

        $fixed_expense       = Expense::whereBetween('date', [$start_date, $end_date])->whereIn('expense_type',['Fixed','Office Expense'])->sum('amount');
        
        $events              = EventDetails::whereBetween('date', [$start_date, $end_date])->where('status', '<>', 2)->orderByDesc('date')->get();
        $total_event_price = 0;
        $single_event_price = 0;
        
        if($event){
            $event_master_count = EventDetails::where('master_id', $event->master_id)->count();
            if ($event_master_count === 1) {
                $payment_amount  = $event->event->payment->payment_amount  ?? 0; 
                $single_event_price += $payment_amount;
            } else {
                $single_event_price += $event->package_price ? $v_event->package_price : $v_event->package->discount;
            }
        }

         foreach ($events as $v_event) {
                $event_master_count = EventDetails::where('master_id', $v_event->master_id)->count();

                if ($event_master_count === 1) {
                    $payment_amount  = $v_event->event->payment->payment_amount  ?? 0; 
                    $total_event_price += $payment_amount;
                } else {
                    $total_event_price += $v_event->package_price ? $v_event->package_price : $v_event->package->discount;
                }
            }
            
            

        if($fixed_expense > 0 ){
            $per_event_expense =  ($fixed_expense / $total_event_price) * $single_event_price ;
           
        }else{
            $per_event_expense = 0;
        }

    // dd($per_event_expense);
        
        
        return view('BackEnd.account.single_event_history',compact('staffPayment','expense','event','event_name','event_date','per_event_expense'));
    }
    
    
    
    
    
        public function daily_ledger(){
         $prev_balance = 0;

         $prev_income                   = Income::where('date','<',date('Y-m-d'))->where('status',1)->where('payment_type','Cash')->sum('amount'); 
        //  $prev_expense                  = Expense::where('date','<',date('Y-m-d'))->whereIn('expense_type',['Variable','Office Expense'])->whereNull('event_id')->sum('amount');
         $prev_expense                  = Expense::where('date','<',date('Y-m-d'))->whereIn('expense_type',['Variable','Fixed'])->where('payment_type','Cash')->sum('amount');

         if($prev_income){
            $prev_balance += $prev_income;
         }

         if($prev_expense){
            $prev_balance -= $prev_expense;
         }
        //  dd($prev_expense );


         $incomes                   = Income::where(['date'=>date('Y-m-d')])->where('payment_type','Cash')->where('status',1)->get(); 
        //  $expenses                  = Expense::where(['date'=>date('Y-m-d')])->whereIn('expense_type',['Variable','Office Expense'])->whereNull('event_id')->get();
         $expenses                  = Expense::where(['date'=>date('Y-m-d')])->where('payment_type','Cash')->whereIn('expense_type',['Variable','Fixed'])->get();


         $date                          = date('Y-m-d');
         $carbonDate                    = Carbon::parse($date);
         $previousDate                  = $carbonDate->subDay();
         $formattedPreviousDate         = $previousDate->toDateString();

         return view('BackEnd.account.daily_ledger', compact('prev_balance','incomes','expenses','formattedPreviousDate','date'));
    }

    public function filter_daily_ledger(Request $request){
        $payment_type           = $request->payment_type;
        $from_date              = $request->start_date;
        $end_date               = $request->end_date;
        $date                   = Carbon::parse($from_date);

        $prev_balance = 0;

         $prev_income                   = Income::where('date','<', $from_date)->where('payment_type',$payment_type)->where('status',1)->sum('amount'); 
        //  $prev_expense                  = Expense::where('date','<', $from_date)->where('payment_type',$payment_type)->whereIn('expense_type',['Variable','Office Expense'])->whereNull('event_id')->sum('amount');
         $prev_expense                  = Expense::where('date','<', $from_date)->where('payment_type',$payment_type)->whereIn('expense_type',['Variable','Fixed'])->sum('amount');

         if($prev_income){
            $prev_balance += $prev_income;
         }

         if($prev_expense){
            $prev_balance -= $prev_expense;
         }

         $carbonDate             = Carbon::parse($from_date);
         $previousDate           = $carbonDate->subDay();
         $formattedPreviousDate  = $previousDate->toDateString();


         $incomes                   = Income::whereBetween('date',[$from_date,$end_date])->where('status',1)->where('payment_type',$payment_type)->get(); 
        //  $expenses                  = Expense::whereBetween('date',[$from_date,$end_date])->where('payment_type',$payment_type)->whereIn('expense_type',['Variable','Office Expense'])->whereNull('event_id')->get();
         $expenses                  = Expense::whereBetween('date',[$from_date,$end_date])->whereIn('expense_type',['Variable','Fixed'])->where('payment_type',$payment_type)->get();

         return view('BackEnd.account.filter_daily_ledger',compact('prev_balance','incomes','expenses','formattedPreviousDate','date','from_date','end_date'));
    }
   

    

}
