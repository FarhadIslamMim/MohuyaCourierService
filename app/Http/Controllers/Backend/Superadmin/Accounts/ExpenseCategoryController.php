<?php

namespace App\Http\Controllers\Backend\Superadmin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense_head_data = [];
        $expense_heads = ExpenseCategory::paginate(10);

        return view('backend.pages.superadmin.accounts.expense.expensecategory', compact('expense_heads', 'expense_head_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_head' => 'required',
        ]);

        $expense_head = new ExpenseCategory();
        $expense_head->expense_head = $request->expense_head;
        $expense_head->save();

        if ($expense_head) {
            $message = 'Expense category added successfully';

            return redirect()->back()->with('success', $message);
        } else {
            return back()->with('error', 'Unable to add expense head');
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
        $expense_head_data = ExpenseCategory::find($id);
        $expense_heads = ExpenseCategory::paginate(10);

        return view('backend.pages.superadmin.accounts.expense.expensecategory', compact('expense_head_data', 'expense_heads'));
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
        ExpenseCategory::where('id', $request->id)->update([
            'expense_head' => $request->expense_head,
        ]);

        return redirect()->route('expense.head.index')->with('success', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExpenseCategory::where('id', $id)->delete();

        return redirect()->route('expense.head.index')->with('success', 'Deleted successfully');
    }
}
