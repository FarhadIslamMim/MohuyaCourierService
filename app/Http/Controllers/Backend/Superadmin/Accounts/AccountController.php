<?php

namespace App\Http\Controllers\Backend\Superadmin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Backend\Accounts\DeliverymanExpense;
use App\Models\DeliverymanAdvance;
use App\Models\DeliveryManSalary;
use App\Models\EmployeeAdvanceSalary;
use App\Models\EmployeeSalary;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Parcel;
use App\Models\PickupmanAdvance;
use App\Models\PickupmanExpense;
use App\Models\PickupmanSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    // trial balance
    public function trialBalance()
    {
        $expenses = Expense::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(quantity * amount)'));
        $incomes = Income::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(quantity * amount)'));
        $returnCharge = Parcel::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(return_charge)'));
        $salary = EmployeeSalary::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(total_paid)'));
        $pickupman_salary = PickupmanSalary::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(total_paid)'));
        $deliveryman_salary = DeliveryManSalary::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(total_paid)'));
        $delivery_charge = Parcel::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(deliveryCharge)'));
        $deliveryMans = DeliverymanExpense::whereMonth('date', Carbon::now()->month)->value(DB::raw('SUM(oil_cost + other_costs)'));
        $pickupmans = PickupmanExpense::whereMonth('date', Carbon::now()->month)->value(DB::raw('SUM(oil_cost + other_costs)'));
        $deliveryman_advance = DeliverymanAdvance::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(advance_amount)'));
        $pickupman_advance = PickupmanAdvance::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(advance_amount)'));
        $employee_advance = EmployeeAdvanceSalary::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(advance_amount)'));
        $deliveryman_comission = Parcel::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(deliveryman_paid)'));
        $pickupman_comission = Parcel::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(pickupman_paid)'));
        $agent_comission = Parcel::whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(agent_paid)'));

        $cod = Parcel::where(['merchantpayStatus' => 1])->whereMonth('created_at', Carbon::now()->month)->value(DB::raw('SUM(codCharge)'));

        return view('backend.pages.superadmin.accounts.trial_balance.trialbalance', compact('expenses', 'incomes', 'salary', 'delivery_charge', 'cod', 'deliveryMans', 'pickupmans', 'returnCharge', 'deliveryman_advance', 'pickupman_advance', 'employee_advance', 'pickupman_salary', 'deliveryman_salary', 'deliveryman_comission', 'pickupman_comission', 'agent_comission'));
    }

    // cashbook
    public function cashBook()
    {
        $expenses = Expense::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(quantity * amount)'));
        $incomes = Income::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(quantity * amount)'));
        $returnCharge = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(return_charge)'));
        $salary = EmployeeSalary::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(total_paid)'));
        $pickupman_salary = PickupmanSalary::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(total_paid)'));
        $deliveryman_salary = DeliveryManSalary::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(total_paid)'));
        $delivery_charge = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(deliveryCharge)'));
        $deliveryMans = DeliverymanExpense::whereDate('date', Carbon::now()->today())->value(DB::raw('SUM(oil_cost + other_costs)'));
        $pickupmans = PickupmanExpense::whereDate('date', Carbon::now()->today())->value(DB::raw('SUM(oil_cost + other_costs)'));
        $deliveryman_advance = DeliverymanAdvance::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(advance_amount)'));
        $pickupman_advance = PickupmanAdvance::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(advance_amount)'));
        $employee_advance = EmployeeAdvanceSalary::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(advance_amount)'));
        $deliveryman_comission = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(deliveryman_paid)'));
        $pickupman_comission = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(pickupman_paid)'));
        $agent_comission = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(agent_paid)'));
        // return $deliveryman_comission;
        $cod = Parcel::where(['merchantpayStatus' => 1])->whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(codCharge)'));

        return view('backend.pages.superadmin.accounts.cashbook.cashbook', compact('expenses', 'incomes', 'salary', 'delivery_charge', 'cod', 'deliveryMans', 'pickupmans', 'returnCharge', 'deliveryman_advance', 'pickupman_advance', 'employee_advance', 'pickupman_salary', 'deliveryman_salary', 'deliveryman_comission', 'pickupman_comission', 'agent_comission'));

    }

    public function ledger(Request $request)
    {
        if($request->startDate !=null && $request->endDate !=null ){
            $expenses = Expense::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(quantity * amount)'));
            $incomes = Income::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(quantity * amount)'));
            $returnCharge = Parcel::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(return_charge)'));
            $salary = EmployeeSalary::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(total_paid)'));
            $pickupman_salary = PickupmanSalary::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(total_paid)'));
            $deliveryman_salary = DeliveryManSalary::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(total_paid)'));
            $delivery_charge = Parcel::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(deliveryCharge)'));
            $deliveryMans = DeliverymanExpense::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(oil_cost + other_costs)'));
            $pickupmans = PickupmanExpense::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(oil_cost + other_costs)'));
            $deliveryman_advance = DeliverymanAdvance::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(advance_amount)'));
            $pickupman_advance = PickupmanAdvance::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(advance_amount)'));
            $employee_advance = EmployeeAdvanceSalary::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(advance_amount)'));
            $deliveryman_comission = Parcel::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(deliveryman_paid)'));
            $pickupman_comission = Parcel::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(pickupman_paid)'));
            $agent_comission = Parcel::whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(agent_paid)'));
            $cod = Parcel::where(['merchantpayStatus' => 1])->whereBetween('created_at', [Carbon::parse($request->startDate), Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(codCharge)'));
            return view('backend.pages.superadmin.accounts.ledger.ledger', compact('expenses', 'incomes', 'salary', 'delivery_charge', 'cod', 'deliveryMans', 'pickupmans', 'returnCharge', 'deliveryman_advance', 'pickupman_advance', 'employee_advance', 'pickupman_salary', 'deliveryman_salary', 'deliveryman_comission', 'pickupman_comission', 'agent_comission'));
        } elseif($request->startDate !=null){
            $expenses = Expense::whereDate('created_at',[Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(quantity * amount)'));
            $incomes = Income::whereDate('created_at', [Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(quantity * amount)'));
            $returnCharge = Parcel::whereDate('created_at', [Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(return_charge)'));
            $salary = EmployeeSalary::whereDate('created_at',[Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(total_paid)'));
            $pickupman_salary = PickupmanSalary::whereDate('created_at', [Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(total_paid)'));
            $deliveryman_salary = DeliveryManSalary::whereDate('created_at', [Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(total_paid)'));
            $delivery_charge = Parcel::whereDate('created_at', [Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(deliveryCharge)'));
            $deliveryMans = DeliverymanExpense::whereDate('date',[Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(oil_cost + other_costs)'));
            $pickupmans = PickupmanExpense::whereDate('date', [Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(oil_cost + other_costs)'));
            $deliveryman_advance = DeliverymanAdvance::whereDate('created_at', [Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(advance_amount)'));
            $pickupman_advance = PickupmanAdvance::whereDate('created_at', [Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(advance_amount)'));
            $employee_advance = EmployeeAdvanceSalary::whereDate('created_at',[Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(advance_amount)'));
            $deliveryman_comission = Parcel::whereDate('created_at',[Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(deliveryman_paid)'));
            $pickupman_comission = Parcel::whereDate('created_at',[Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(pickupman_paid)'));
            $agent_comission = Parcel::whereDate('created_at',[Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(agent_paid)'));
            $cod = Parcel::where(['merchantpayStatus' => 1])->whereDate('created_at', [Carbon::parse($request->startDate)->endOfDay()])->value(DB::raw('SUM(codCharge)'));
            return view('backend.pages.superadmin.accounts.ledger.ledger', compact('expenses', 'incomes', 'salary', 'delivery_charge', 'cod', 'deliveryMans', 'pickupmans', 'returnCharge', 'deliveryman_advance', 'pickupman_advance', 'employee_advance', 'pickupman_salary', 'deliveryman_salary', 'deliveryman_comission', 'pickupman_comission', 'agent_comission'));

        }elseif ($request->endDate !=null){
            $expenses = Expense::whereDate('created_at',[Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(quantity * amount)'));
            $incomes = Income::whereDate('created_at', [Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(quantity * amount)'));
            $returnCharge = Parcel::whereDate('created_at', [Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(return_charge)'));
            $salary = EmployeeSalary::whereDate('created_at',[Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(total_paid)'));
            $pickupman_salary = PickupmanSalary::whereDate('created_at', [Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(total_paid)'));
            $deliveryman_salary = DeliveryManSalary::whereDate('created_at', [Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(total_paid)'));
            $delivery_charge = Parcel::whereDate('created_at', [Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(deliveryCharge)'));
            $deliveryMans = DeliverymanExpense::whereDate('date',[Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(oil_cost + other_costs)'));
            $pickupmans = PickupmanExpense::whereDate('date', [Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(oil_cost + other_costs)'));
            $deliveryman_advance = DeliverymanAdvance::whereDate('created_at', [Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(advance_amount)'));
            $pickupman_advance = PickupmanAdvance::whereDate('created_at', [Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(advance_amount)'));
            $employee_advance = EmployeeAdvanceSalary::whereDate('created_at',[Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(advance_amount)'));
            $deliveryman_comission = Parcel::whereDate('created_at',[Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(deliveryman_paid)'));
            $pickupman_comission = Parcel::whereDate('created_at',[Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(pickupman_paid)'));
            $agent_comission = Parcel::whereDate('created_at',[Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(agent_paid)'));
            $cod = Parcel::where(['merchantpayStatus' => 1])->whereDate('created_at', [Carbon::parse($request->endDate)->endOfDay()])->value(DB::raw('SUM(codCharge)'));
            return view('backend.pages.superadmin.accounts.ledger.ledger', compact('expenses', 'incomes', 'salary', 'delivery_charge', 'cod', 'deliveryMans', 'pickupmans', 'returnCharge', 'deliveryman_advance', 'pickupman_advance', 'employee_advance', 'pickupman_salary', 'deliveryman_salary', 'deliveryman_comission', 'pickupman_comission', 'agent_comission'));

        }else{
            $expenses = Expense::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(quantity * amount)'));
            $incomes = Income::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(quantity * amount)'));
            $returnCharge = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(return_charge)'));
            $salary = EmployeeSalary::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(total_paid)'));
            $pickupman_salary = PickupmanSalary::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(total_paid)'));
            $deliveryman_salary = DeliveryManSalary::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(total_paid)'));
            $delivery_charge = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(deliveryCharge)'));
            $deliveryMans = DeliverymanExpense::whereDate('date', Carbon::now()->today())->value(DB::raw('SUM(oil_cost + other_costs)'));
            $pickupmans = PickupmanExpense::whereDate('date', Carbon::now()->today())->value(DB::raw('SUM(oil_cost + other_costs)'));
            $deliveryman_advance = DeliverymanAdvance::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(advance_amount)'));
            $pickupman_advance = PickupmanAdvance::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(advance_amount)'));
            $employee_advance = EmployeeAdvanceSalary::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(advance_amount)'));
            $deliveryman_comission = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(deliveryman_paid)'));
            $pickupman_comission = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(pickupman_paid)'));
            $agent_comission = Parcel::whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(agent_paid)'));
            $cod = Parcel::where(['merchantpayStatus' => 1])->whereDate('created_at', Carbon::now()->today())->value(DB::raw('SUM(codCharge)'));
            return view('backend.pages.superadmin.accounts.ledger.ledger', compact('expenses', 'incomes', 'salary', 'delivery_charge', 'cod', 'deliveryMans', 'pickupmans', 'returnCharge', 'deliveryman_advance', 'pickupman_advance', 'employee_advance', 'pickupman_salary', 'deliveryman_salary', 'deliveryman_comission', 'pickupman_comission', 'agent_comission'));

        }
    }
}
