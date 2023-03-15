<?php

namespace App\Http\Controllers\Backend\Superadmin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Backend\Accounts\DeliverymanExpense;
use App\Models\Deliveryman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;

class DeliverymanExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grand_total = 0;
        $start_date = 0;
        $end_date = 0;
        $deliveryman_id = 0;
        $deliverymans = Deliveryman::select('id', 'name', 'phone')->get();
        $expenses = DeliverymanExpense::where('deliveryman_id', $request->deliveryman_id)->with('deliverymanDetails')->whereBetween('date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->get();
        $grand_total = DeliverymanExpense::where('deliveryman_id', $request->deliveryman_id)->whereBetween('date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->sum(DB::raw('oil_cost + other_costs'));
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $deliveryman_id = $request->deliveryman_id;

        return view('backend.pages.superadmin.accounts.deliveryman.expenses', compact('deliverymans', 'expenses', 'grand_total', 'start_date', 'end_date', 'deliveryman_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deliverymans = Deliveryman::select('id', 'name', 'phone')->get();

        return view('backend.pages.superadmin.accounts.deliveryman.create', compact('deliverymans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'date' => 'required|date',
            'deliveryman_id' => 'required|numeric',
            'oil_cost' => 'required|numeric',
            'other_costs' => 'required|numeric',
        ]);

        //check if exists
        $check = DeliverymanExpense::where(['deliveryman_id' => $request->deliveryman_id, 'date' => $request->date])->exists();

        if (! $check) {
            $deliveryman_expense = new DeliverymanExpense();
            $deliveryman_expense->date = $request->date;
            $deliveryman_expense->deliveryman_id = $request->deliveryman_id;
            $deliveryman_expense->oil_cost = $request->oil_cost;
            $deliveryman_expense->other_costs = $request->other_costs;
            $deliveryman_expense->authorized_by = Auth::user()->id;
            $deliveryman_expense->save();

            if ($deliveryman_expense) {
                return redirect()->back()->with('success', 'Expense addess successfully');
            }
        } else {
            return redirect()->back()->with('error', 'Expense already added for this Deliveryman');
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DeliverymanExpense::find($id);
        // return $data;
        return view('backend.pages.superadmin.accounts.deliveryman.edit', compact('data'));
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
        DeliverymanExpense::where('id', $request->expense_id)->update([
            'date' => $request->date,
            'oil_cost' => $request->oil_cost,
            'other_costs' => $request->other_costs,
        ]);

        return back()->with('success', 'Exense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DeliverymanExpense::where('id', $id)->delete();

        return back()->with('success', 'Delete successfully');
    }

    /**
     * print the specified resource from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        // return $request->all();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $deliveryman_id = $request->deliveryman_id;
        $datas = DeliverymanExpense::where('deliveryman_id', $deliveryman_id)->with('deliverymanDetails')->whereBetween('date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->get();
        $deliveryman_man = DeliverymanExpense::where('deliveryman_id', $deliveryman_id)->with('deliverymanDetails')->first();
        // return $deliveryman_man;
        $grand_total = DeliverymanExpense::where('deliveryman_id', $deliveryman_id)->whereBetween('date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->sum(DB::raw('oil_cost + other_costs'));
        // return $grand_total;
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $words = ucfirst($numberTransformer->toWords($grand_total));

        return view('backend.pages.superadmin.accounts.deliveryman.print', compact('datas', 'grand_total', 'words', 'deliveryman_man', 'start_date', 'end_date'));
    }
}
