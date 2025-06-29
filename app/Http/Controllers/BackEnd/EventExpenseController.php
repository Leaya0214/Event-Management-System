<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\BackEnd\Expense;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\EventDetails;
use App\Models\BackEnd\Expensecategory;
use Illuminate\Support\Facades\Validator;

class EventExpenseController extends Controller
{
    public function eventExpense($id){
        $categories = Expensecategory::all();
        $event      = EventDetails::find($id);
        return view('BackEnd.webcontent.event.add_expense',compact('categories','event'));
    }

    public function storeEventExpenses(Request $request){
        // return $request->all();
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

        $expenseArr = [];

        $expense_category = count($request->category_id);


        for ($i = 0; $i < $expense_category; $i++) {
            //Invoice Number Generate
            $latestExpense = Expense::latest()->first();
           $invoice = $latestExpense ? "EXP-0" . ($latestExpense->id + $i + 1 ) : "EXP-01";

            if ($request->hasFile('document') && isset($request->file('document')[$i])) {
                    $file = $request->file('document')[$i];
                    $file_enc_name = $file->getClientOriginalName();
                    $file_name = time() . '_' . $file_enc_name; 
                    $destination_path = "backend/expense/";
                    $file->move($destination_path, $file_name);
                
            }else{
                $file_name = '';
            }
            $expense = new Expense;
            $expense->invoice_no = $invoice;
            $expense->category_id = $request->input('category_id')[$i];
            $expense->expense_type = "Variable";
            $expense->event_id = $request->input('event_id')[$i];
            $expense->remarks = $request->input('remarks')[$i];
            $expense->amount = $request->input('amount')[$i];
            $expense->date = $request->input('date')[$i];
            $expense->payment_type = $request->input('payment_type')[$i];
            $expense->expense_type = $request->input('expense_type')[$i];
            $expense->transaction_id = $request->input('transaction_id')[$i];
            $expense->account_no = $request->input('account_no')[$i];
            $expense->document = $file_name; 
            $expense->save();
        }
        Toastr::success("Expense  Data Stored Successfully!");
        return redirect()->back();

    }


}
