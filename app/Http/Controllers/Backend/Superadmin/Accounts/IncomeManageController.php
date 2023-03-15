<?php

namespace App\Http\Controllers\Backend\Superadmin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeCateogry;
use App\Models\IncomeInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;

class IncomeManageController extends Controller
{

    public function index(Request $request)
    {
         if ($request->start_date != null && $request->end_date != null){
             $income_invoices = IncomeInvoice::with('getIncomeDetails')->whereBetween('created_at', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->start_date !=null){
             $income_invoices = IncomeInvoice::with('getIncomeDetails')->whereDate('created_at', [Carbon::parse($request->start_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }elseif ($request->end_date !=null){
             $income_invoices = IncomeInvoice::with('getIncomeDetails')->whereDate('created_at', [Carbon::parse($request->end_date)->endOfDay()])->orderBy('created_at','ASC')->get();
        }else{
            $income_invoices = IncomeInvoice::with('getIncomeDetails')->orderBy('created_at', 'desc')->get();
        }
        return view('backend.pages.superadmin.accounts.income.income', compact('income_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $income_heads = IncomeCateogry::all();

        return view('backend.pages.superadmin.accounts.income.create', compact('income_heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
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
                'date_of_income' => $request->date_of_income,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            Income::insert($data);
        }
        IncomeInvoice::insert([
            'invoice_id' => $invoice_no,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Income added. Invoice ID #' . $invoice_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $invoices = IncomeInvoice::where('invoice_id', $id)->with('getIncomeDetails')->get();
        $income_heads = IncomeCateogry::all();
        $grand_total = Income::where('invoice_id', $id)->sum(DB::raw('quantity * amount'));
        $date = Income::where('invoice_id', $id)->select('date_of_income')->first();
        // return $date;
        // create the number to words "manager" class
        $numberToWords = new NumberToWords();

        // build a new number transformer using the RFC 3066 language identifier
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $words = ucfirst($numberTransformer->toWords($grand_total));

        return view('backend.pages.superadmin.accounts.income.show', compact('invoices', 'income_heads', 'grand_total', 'words', 'date'));
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
        $get_incomes = IncomeInvoice::where('invoice_id', $id)->with('getIncomeDetails')->get();
        $income_heads = IncomeCateogry::all();
        $grand_total = Income::where('invoice_id', $id)->sum(DB::raw('quantity * amount'));

        return view('backend.pages.superadmin.accounts.income.edit', compact('get_incomes', 'income_heads', 'grand_total'));
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
        // return $request->all();
        $delete = Income::where('invoice_id', $request->invoice_id)->delete();
        if ($delete) {
            foreach ($request->head_id ?? [] as $key => $value) {
                $data = [
                    'cat_id' => $request->head_id[$key],
                    'remarks'   => $request->remarks[$key],
                    'quantity' => $request->quantity[$key],
                    'amount' => $request->amount[$key],
                    'subtotal' => $request->amount[$key],
                    'grand_total' => $request->grand_total,
                    'date_of_income' => $request->date_of_income,
                    'invoice_id' => $request->invoice_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                Income::insert($data);
            }
            IncomeInvoice::where('invoice_id', $request->invoice_id)->update([
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'Income updated successfully');
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
        $delete = Income::where('invoice_id', $id)->delete();
        $delete = IncomeInvoice::where('invoice_id', $id)->delete();

        return back()->with('success', 'Income deleted successfully');
    }
}
