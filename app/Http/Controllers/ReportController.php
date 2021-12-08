<?php

namespace App\Http\Controllers;

use App\Models\CustomerCredit;
use App\Models\CustomerReward;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Adjustment;
use App\Models\PurchaseItem;

use App\Models\Expense;
use App\Models\ExpenseCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function consolidateRewardReport()
    {
       $credits=CustomerReward::with('customer')->where('created_at','!=',NULL)->get();
       $groups = $credits->groupBy('customer_id'); 
       
     

       $groupwithsum = $groups->mapWithKeys(function ($group, $key) 
       {
            return 
            [
                $key =>
                    [
                        'customer_id' => $key, // $key is what we grouped by, it'll be constant by each  group of rows
                        'customer_name' => Customer::where('id',$key)->value('name'),
                        'customer_mobile' => Customer::where('id',$key)->value('mobile'),
                        'transactions_count' => $group->count(),
                        'points' => $group->sum('points'),
                        
                    ]
            ];
        });
       return $groupwithsum->sortByDesc('points')->values();
    }   
    

    public function rewardReportByCustomer(Request $request)
    {
        
        $rewards=CustomerReward::with('customer:id,name,mobile')->where('customer_id',$request->customer_id)->get();
        return $rewards;
    }

    public function consolidateCreditReport()
    {
       $credits=CustomerCredit::with('customer')->where('created_at','!=',NULL)->get();
       $groups = $credits->groupBy('customer_id'); 
       
    

       $groupwithsum = $groups->mapWithKeys(function ($group, $key) 
       {
            return 
            [
                $key =>
                    [
                        'customer_id' => $key, // $key is what we grouped by, it'll be constant by each  group of rows
                        'customer_name' => Customer::where('id',$key)->value('name'),
                        'transactions_count' => $group->count(),
                        'amount' => $group->sum('amount'),
                        
                    ]
            ];
        });
       return $groupwithsum->sortByDesc('amount')->values();
    }

    public function creditReportByCustomer(Request $request)

    {
      
        $credits=CustomerCredit::with('customer')->where('customer_id',$request->customer_id) ->get();
        return $credits;
    }

    public function getCreditSalesByInvoice(Request $request)
    {
        $credit_sales =  Sale::with('items', 'customer')->where([['customer_id',$request->customer_id],['bill_type',1]])->orderBy('id','desc')->get();
        return $credit_sales;
    }

    public function itemReport(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);

        $product =  Product::where('id',$request->product_id)->first();
        $adjustments = Adjustment::select('increase_quantity','decrease_quantity','created_at')->where('product_id',$request->product_id)->get();
        $transactions=[];
        $array1=[];
        foreach ($adjustments as $key => $value) {
          
            if($value->increase_quantity >0)
            {
                $transactions[$key]['type'] = 1;
                $transactions[$key]['description'] = "Increased through adjustments";
                $transactions[$key]['quantity'] = $value->increase_quantity;
                $transactions[$key]['date'] = date($value->created_at);
                
            }
            else if($value->decrease_quantity >0)
            {
                $transactions[$key]['type'] = 2;
                $transactions[$key]['description'] = "Decreased through adjustments";
                $transactions[$key]['quantity'] = $value->decrease_quantity;
                $transactions[$key]['date'] = date($value->created_at);
            }
            array_push($array1,$transactions[$key]);
            
        }
       
        //return $transactions;
        $sale_items = SaleItem::select('sale_id','quantity','created_at')->where('product_id',$request->product_id)->get();
      
        foreach ($sale_items as $key => $value) {
          
            
       
                $transactions[$key]['type'] = 2;
                $transactions[$key]['description'] = "Decreased through invoice ".+ $value->sale_id;
                $transactions[$key]['quantity'] = $value->quantity;
                $transactions[$key]['date'] = date($value->created_at);
            
                array_push($array1,$transactions[$key]);
        }

        $purchase_items = PurchaseItem::select('purchase_id','purchase_qty','created_at')->where('product_id',$request->product_id)->get();
      
        foreach ($purchase_items as $key => $value) {
          
            
       
                $transactions[$key]['type'] = 1;
                $transactions[$key]['description'] = "Increased through purchase ".+ $value->purchase_id;
                $transactions[$key]['quantity'] = $value->purchase_qty;
                $transactions[$key]['date'] = date($value->created_at);
            
                array_push($array1,$transactions[$key]);
        }
        $sorted= collect($array1)->sortBy('date')->values()->all();;
        $item_details[] = [
            'product_name'  => $product->name,
            'opening_quantity'  => $product->opening_quantity,
            'current_quantity'  => $product->quantity,
            'transactions'       =>$sorted,
           
        ];
        return $item_details;
    }

    public function profitReport(Request $request)
    {
        $expenses=Expense::with('expensecategory')->where('created_at','!=',NULL)->get();
        $expense_groups = $expenses->groupBy('expense_category_id'); 
        
      
 
        $expense_groups_filter = $expense_groups->mapWithKeys(function ($group, $key) 
        {
             return 
             [
                 $key =>
                     [
                         'expense_category_id' => $key, // $key is what we grouped by, it'll be constant by each  group of rows
                         'expense_category' => ExpenseCategory::where('id',$key)->value('name'),
                         'expense_amount' => $group->sum('amount'),
                         
                     ]
             ];
         });
        $expenses_groupby_category = $expense_groups_filter->sortByDesc('expense_amount')->values();

        $details_array[] = [
            'expenses_groupby_category'=>$expenses_groupby_category,
            'total_expenses'=>$expenses->sum('amount'),
            'total_cash_expenses'=>$expenses->where('pay_type','Cash')->sum('amount'),
            'total_bank_expenses'=>$expenses->where('pay_type','Bank')->sum('amount'),

        ];
        return $details_array;

    }

}
