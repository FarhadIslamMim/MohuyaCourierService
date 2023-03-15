<?php

namespace App\Http\Controllers\Backend\Superadmin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Pickupman;
use App\Models\PickupmanExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;

class PickupmanExpenseController extends Controller
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
        $pickupman_id = 0;
        $pickupmans = Pickupman::select('id', 'name', 'phone')->get();
        $expenses = PickupmanExpense::where('pickupman_id', $request->pickupman_id)->with('pickupmanDetails')->whereBetween('date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->get();
        $grand_total = PickupmanExpense::where('pickupman_id', $request->pickupman_id)->whereBetween('date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->sum(DB::raw('oil_cost + other_costs'));
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $pickupman_id = $request->pickupman_id;

        return view('backend.pages.superadmin.accounts.pickupman.expenses', compact('pickupmans', 'expenses', 'grand_total', 'start_date', 'end_date', 'pickupman_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pickupmans = pickupman::select('id', 'name', 'phone')->get();

        return view('backend.pages.superadmin.accounts.pickupman.create', compact('pickupmans'));
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
            'pickupman_id' => 'required|numeric',
            'oil_cost' => 'required|numeric',
            'other_costs' => 'required|numeric',
        ]);

        //check if exists
        $check = PickupmanExpense::where(['pickupman_id' => $request->pickupman_id, 'date' => $request->date])->exists();

        if (! $check) {
            $pickupman_expense = new PickupmanExpense();
            $pickupman_expense->date = $request->date;
            $pickupman_expense->pickupman_id = $request->pickupman_id;
            $pickupman_expense->oil_cost = $request->oil_cost;
            $pickupman_expense->other_costs = $request->other_costs;
            $pickupman_expense->authorized_by = Auth::user()->id;
            $pickupman_expense->save();

            if ($pickupman_expense) {
                return redirect()->back()->with('success', 'Expense addess successfully');
            }
        } else {
            return redirect()->back()->with('error', 'Expense already added for this pickupman');
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
        $data = PickupmanExpense::find($id);
        // return $data;
        return view('backend.pages.superadmin.accounts.pickupman.edit', compact('data'));
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
        PickupmanExpense::where('id', $request->expense_id)->update([
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
        PickupmanExpense::where('id', $id)->delete();

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
        $pickupman_id = $request->pickupman_id;
        $datas = PickupmanExpense::where('pickupman_id', $pickupman_id)->with('pickupmanDetails')->whereBetween('date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->get();
        $pickupman = PickupmanExpense::where('pickupman_id', $pickupman_id)->with('pickupmanDetails')->first();
        // return $pickupman;
        $grand_total = PickupmanExpense::where('pickupman_id', $pickupman_id)->whereBetween('date', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)->endOfDay()])->sum(DB::raw('oil_cost + other_costs'));
        // return $grand_total;
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $words = ucfirst($numberTransformer->toWords($grand_total));

        return view('backend.pages.superadmin.accounts.pickupman.print', compact('datas', 'grand_total', 'words', 'pickupman', 'start_date', 'end_date'));
    }
}
