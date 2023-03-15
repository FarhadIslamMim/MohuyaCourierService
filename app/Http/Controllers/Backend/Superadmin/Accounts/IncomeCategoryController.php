<?php

namespace App\Http\Controllers\Backend\Superadmin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\IncomeCateogry;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income_head_data = [];
        $income_heads = IncomeCateogry::paginate(10);

        return view('backend.pages.superadmin.accounts.income.incomecategory', compact('income_heads', 'income_head_data'));
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
            'income_head' => 'required',
        ]);

        $income_head = new IncomeCateogry();
        $income_head->income_head = $request->income_head;
        $income_head->save();

        if ($income_head) {
            $message = 'Head added successfully';

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
        $income_head_data = IncomeCateogry::find($id);
        $income_heads = IncomeCateogry::paginate(10);

        return view('backend.pages.superadmin.accounts.income.incomecategory', compact('income_head_data', 'income_heads'));
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
        IncomeCateogry::where('id', $request->id)->update([
            'income_head' => $request->income_head,
        ]);

        return redirect()->route('income.head.index')->with('success', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IncomeCateogry::where('id', $id)->delete();

        return redirect()->route('income.head.index')->with('success', 'Deleted successfully');
    }
}
