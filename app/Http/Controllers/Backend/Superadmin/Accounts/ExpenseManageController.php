<?php

namespace App\Http\Controllers\Backend\Superadmin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;

class ExpenseManageController extends Controller
{

    public function index(Request $request)
    {
        if ($request->start_date != null && $request->end_date != null){
            $expense_invoices = ExpenseInvoice::with('getExpenseDetails')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->start_date !=null){
            $expense_invoices = ExpenseInvoice::with('getExpenseDetails')->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->end_date !=null){
            $expense_invoices = ExpenseInvoice::with('getExpenseDetails')->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }else{
            $expense_invoices = ExpenseInvoice::with('getExpenseDetails')->orderBy('created_at', 'desc')->get();
        }
        return view('backend.pages.superadmin.accounts.expense.expense', compact('expense_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expense_heads = ExpenseCategory::all();

        return view('backend.pages.superadmin.accounts.expense.create', compact('expense_heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice_no = mt_rand(1111, 9999);
        foreach ($request->head_id ?? [] as $key => $value) {
            $data = [
                'cat_id' => $request->head_id[$key],
                'remarks' => $request->remarks[$key],
                'quantity' => $request->quantity[$key],
                'amount' => $request->amount[$key],
                'subtotal' => $request->amount[$key],
                'grand_total' => $request->grand_total,
                'invoice_id' => $invoice_no,
                'date_of_expense' => $request->date_of_expense,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            Expense::insert($data);
        }
        ExpenseInvoice::insert([
            'invoice_id' => $invoice_no,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Expense added. Invoice ID #' . $invoice_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $invoices = ExpenseInvoice::where('invoice_id', $id)->with('getExpenseDetails')->get();

        // return $invoices;

        $expense_heads = ExpenseCategory::all();
        $grand_total = Expense::where('invoice_id', $id)->sum(DB::raw('quantity * amount'));
        $date = Expense::where('invoice_id', $id)->select('date_of_expense')->first();
        // create the number to words "manager" class
        $numberToWords = new NumberToWords();

        // build a new number transformer using the RFC 3066 language identifier
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $words = ucfirst($numberTransformer->toWords($grand_total));

        return view('backend.pages.superadmin.accounts.expense.show', compact('invoices', 'expense_heads', 'grand_total', 'words', 'date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $get_expenses = ExpenseInvoice::where('invoice_id', $id)->with('getExpenseDetails')->get();
        $expense_heads = ExpenseCategory::all();
        $grand_total = Expense::where('invoice_id', $id)->sum(DB::raw('quantity * amount'));

        return view('backend.pages.superadmin.accounts.expense.edit', compact('get_expenses', 'expense_heads', 'grand_total'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $delete = Expense::where('invoice_id', $request->invoice_id)->delete();
        if ($delete) {
            foreach ($request->head_id ?? [] as $key => $value) {
                $data = [
                    'cat_id' => $request->head_id[$key],
                    'remarks' => $request->remarks[$key],
                    'quantity' => $request->quantity[$key],
                    'amount' => $request->amount[$key],
                    'subtotal' => $request->amount[$key],
                    'grand_total' => $request->grand_total,
                    'invoice_id' => $request->invoice_id,
                    'date_of_expense' => $request->date_of_expense,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                Expense::insert($data);
            }
            ExpenseInvoice::where('invoice_id', $request->invoice_id)->update([
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'Expense updated successfully');
        } else {
            return redirect()->back()->with('error', 'Unable updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Expense::where('invoice_id', $id)->delete();
        $delete = ExpenseInvoice::where('invoice_id', $id)->delete();

        return back()->with('success', 'Expense deleted successfully');
    }
}
