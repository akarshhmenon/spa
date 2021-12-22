<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\CustomerReward;
use App\Models\CustomerCredit;
use App\Models\Customer;
use App\Models\Income;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class DashboardController extends Controller
{
    public function report(Request $request)
    {
        // $sales =  Sale::with('items', 'customer');
        $products = Product::where('category_id', 1)
            ->select('name', 'quantity')
            ->orderBy('quantity')->get();

        $filtered = $products->filter(function ($product) {
            if ($product->quantity > 0) {
                return $product;
            }
        });

        $low_stock_item_names = [];
        $low_stock_item_quantities = [];
        foreach ($filtered as $product) {
            array_push($low_stock_item_names, $product->name);
            array_push($low_stock_item_quantities, $product->quantity);
        }

        $credits = CustomerCredit::with('customer')->get();
        $groups = $credits->groupBy('customer_id');

        $groupwithsum = $groups->mapWithKeys(function ($group, $key) {
            return
                [
                    $key =>
                    [
                        'customer_id' => $key, // $key is what we grouped by, it'll be constant by each  group of rows
                        'customer_name' => Customer::where('id', $key)->value('name'),
                        'amount' => $group->sum('amount'),

                    ]
                ];
        });

        $payments = Payment::with('customer:id,name,mobile');
        $incomes = Income::select('income_category_id', 'amount', 'pay_type', 'created_at')->with('incomecategory:id,name');
        $expenses = Expense::select('expense_category_id', 'amount', 'pay_type', 'created_at')->with('expensecategory:id,name');
        $sales =  Sale::with('items', 'customer');
        $sale_items =  SaleItem::with('product:id,name')->where('category_id', '!=', 2);


        //for dashboard data export date
        if ($request->from_date != '' && $request->to_date != '') {
            $print_date = Carbon::parse($request->from_date)->format('d-m-Y') . ' to ' . Carbon::parse($request->to_date)->format('d-m-Y');
        } elseif ($request->from_date != '' && $request->to_date == '') {
            $print_date = 'Report From  ' . Carbon::parse($request->from_date)->format('d-m-Y');
        } elseif ($request->from_date == '' && $request->to_date != '') {
            $print_date = 'Report Upto  ' . Carbon::parse($request->to_date)->format('d-m-Y');
        } else {
            $print_date = Carbon::now()->format('d-m-Y');
        }



        if ($request->from_date) {

            $sales =   $sales->where('invoice_date', '>=', $request->from_date);
            $payments = $payments->where('payment_date', '>=', $request->from_date);
            $incomes = $incomes->where('created_at', '>=', $request->from_date);
            $expenses = $expenses->where('created_at', '>=', $request->from_date);
            $sale_items = $sale_items->where('created_at', '>=', $request->from_date);
        }
        if ($request->to_date) {

            $sales->where('invoice_date', '<=', $request->to_date);
            $payments = $payments->where('payment_date', '<=', $request->to_date);
            $incomes = $incomes->where('created_at', '<=', $request->to_date);
            $expenses = $expenses->where('created_at', '<=', $request->to_date);
            $sale_items = $sale_items->where('created_at', '<=', $request->to_date);
        }
        if (!$request->from_date && !$request->to_date) {
            $sales =  $sales->whereDate('invoice_date', Carbon::today());
            $payments =  $payments->whereDate('payment_date', Carbon::today());
            $incomes = $incomes->whereDate('created_at', Carbon::today());
            $expenses = $expenses->whereDate('created_at', Carbon::today());
            $sale_items = $sale_items->whereDate('created_at', Carbon::today());
        }

        $sales =  $sales->get();
        $payments =  $payments->get();
        $incomes = $incomes->get();
        $expenses = $expenses->get();
        $sale_items = $sale_items->get();

        //expense category wise

        $expense_groups = $expenses->groupBy('expense_category_id');

        $expense_groups_filter = $expense_groups->mapWithKeys(function ($group1, $key1) {
            return
                [
                    $key1 =>
                    [
                        'expense_category_id' => $key1, // $key is what we grouped by, it'll be constant by each  group of rows
                        'expense_category' => ExpenseCategory::where('id', $key1)->value('name'),
                        'expense_amount' => $group1->sum('amount'),

                    ]
                ];
        });


        $expenses_groupby_category = $expense_groups_filter->sortByDesc('expense_amount')->values();

        $piechart_expense_category_name = [];
        $piechart_expense_category_amount = [];
        foreach ($expenses_groupby_category as $expense_item) {

            array_push($piechart_expense_category_name, $expense_item['expense_category']);
            array_push($piechart_expense_category_amount, $expense_item['expense_amount']);
        }

        $piechart_income_category_names = ['sale payments', 'credit payments', 'other incomes'];
        $piechart_income_category_values = [];
        array_push($piechart_income_category_values,  $payments->where('credit', 0)->sum('amount'));
        array_push($piechart_income_category_values, $payments->where('credit', 1)->sum('amount'));
        array_push($piechart_income_category_values, $incomes->sum('amount'));


        $piechart_income_payment_names = ['Cash', 'Bank'];
        $cash = $payments->where('pay_type', 'Cash')->sum('amount') + $incomes->where('pay_type', 'Cash')->sum('amount');
        $bank = $payments->where('pay_type', 'Bank')->sum('amount') + $incomes->where('pay_type', 'Bank')->sum('amount');
        $piechart_income_payment_values = [$cash, $bank];

        $total_expenses = $expenses->sum('amount');
        $total_cash_expenses = $expenses->where('pay_type', 'Cash')->sum('amount');
        $total_bank_expenses = $expenses->where('pay_type', 'Bank')->sum('amount');

        $total_incomes = $cash + $bank;
        $total_profit = $total_incomes - $total_expenses;


        $total_bank_profit = $bank - $total_bank_expenses;
        $total_cash_profit = $cash - $total_cash_expenses;

        $details[] = [

            'total_sales'  => $sales->count(),
            'total_sale_amount'  => $sales->sum('pay_amount'),
            'total_sale_credit_amount'  => $sales->where('bill_type', 1)->sum('pay_amount'),
            'total_itemsale_amount'  => $sale_items->where('category_id', 1)->sum('total_rate'),
            'total_servicesale_amount'  => $sale_items->where('category_id', 3)->sum('total_rate'),
            'sale_item_details' => $sale_items->where('category_id', 1),
            'service_item_details' => $sale_items->where('category_id', 3),
            'low_stock_items' => $filtered,
            'low_stock_item_names' => $low_stock_item_names,
            'low_stock_item_quantities' => $low_stock_item_quantities,
            'piechart_income_category_names' => $piechart_income_category_names,
            'piechart_income_category_values' => $piechart_income_category_values,
            'piechart_income_payment_names' => $piechart_income_payment_names,
            'piechart_income_payment_values' => $piechart_income_payment_values,
            'piechart_expense_category_name' => $piechart_expense_category_name,
            'piechart_expense_category_amount' => $piechart_expense_category_amount,
            'customer_with_credits' => $groupwithsum->sortByDesc('amount')->values()->take(20),
            'total_payments_received' => $cash + $bank,
            'total_cash_payments_received' => $cash,
            'total_bank_payments_received' => $bank,
            'Total Payments' => $payments,
            'total_incomes_received' => $incomes->sum('amount'),
            'total_cash_incomes_received' => $incomes->where('pay_type', 'Cash')->sum('amount'),
            'total_bank_incomes_received' => $incomes->where('pay_type', 'Bank')->sum('amount'),
            'total_expenses_received' => $total_expenses,
            'total_cash_expenses_received' => $total_cash_expenses,
            'total_bank_expenses_received' => $total_bank_expenses,
            'expenses_category_wise' => $expenses_groupby_category,
            'total_profit' => $total_profit,
            'total_bank_profit' => $total_bank_profit,
            'total_cash_profit' => $total_cash_profit,
            'expense_list' => $expenses,
            'print_date' => $print_date,

        ];
        return $details;
    }
}
