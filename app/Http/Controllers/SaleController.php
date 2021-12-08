<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\CustomerReward;
use App\Models\CustomerCredit;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    public function save(Request $request)
    {

        $request->validate([
            'name'=>'unique:customers,name',
            'bill_type' => 'required',
            'mobile'=>'unique:customers,mobile',

        ]);

        if ($request->id) {

            $sale = Sale::FindOrFail($request->id);
            $invoice_no = $sale->invoice_no;
            $saleitems = SaleItem::where('sale_id', $sale->invoice_no)->get();
            if ($saleitems) {
                foreach ($saleitems as $saleitem) {

                    //updating quantity under product table
                    if ($saleitem->category_id == 1) {
                        $product = Product::FindOrFail($saleitem->product_id);
                        if($product)
                        {
                            $product->quantity = $product->quantity + $saleitem->quantity;
                            $product->save();
                        }
                        else
                            return "Error";

                    }

                    //deleting saleitem one by one
                    $saleitem->delete();
                }
            }

            //deleting reward points entry in ustomer_rewards table
            $customer_reward = CustomerReward::where('invoice_no', $sale->invoice_no)->first();
            if ($customer_reward)
                $customer_reward->delete();

            //deleting reward points entry in ustomer_rewards table
            $payment = Payment::where('invoice_no', $sale->invoice_no)->first();
            if ($payment)
                 $payment->delete();

            //deleting from Credit Table
            if ($sale->bill_type == 1) {
                $customer_credit = CustomerCredit::where('invoice_no', $sale->invoice_no)->first();
                if ($customer_credit)
                    $customer_credit->delete();
            }
        } else {
            $sale = new Sale;
        }


        if (!$request->id) {
            $last_record = Sale::all();

            $last_record_id = Sale::latest()->first();

            if ($last_record->isEmpty())
                $invoice_no = 1;
            else
                $invoice_no = $last_record_id->id + 1;
        }

        $sale->invoice_no = $invoice_no;

        $sale->user_id = Auth::user()->id;

        //adding bill type (1-CREDIT or 2-CASH)
        $sale->bill_type = $request->bill_type;
        if($request->customer_id)
            $sale->customer_id = $request->customer_id;
        else
        {
            $new_customer = new Customer();
            $new_customer->user_id = Auth::user()->id;
$new_customer->name = strtoupper($request->name);
            $new_customer->mobile = $request->mobile;
            $new_customer->gst_no = $request->gst_no;
            $new_customer->save();
            $sale->customer_id = $new_customer->id;

        }
        $sale->gst_bill = $request->gst_bill;



        if ($request->vehicle)
            $sale->vehicle = $request->vehicle;


        if ($request->register_no) {
            //To make register_no clean ie KL-11-A-134 / KL 11 A 134 / KL-11 A 134 becomes KL11A134
            $register_no = preg_replace('/[^A-Za-z0-9]/', '', strtoupper($request->register_no));
            $sale->register_no = $register_no;
        }



        //If date is selected or current date
        if ($request->date)
            $sale->invoice_date = $request->date;
        else
            $sale->invoice_date = date('Y-m-d');

        $total_amount = 0;
        $total_discount = 0;
        $total_gst = 0;
        $total_taxable_amount=0;
        $check=0;

        $user_id = Auth::user()->id;
        foreach ($request->items as $item) {

            $saleitem = new SaleItem;
            $saleitem->user_id = $user_id;
            $saleitem->sale_id = $invoice_no;
            $saleitem->category_id = $item['category_id'];
            if($saleitem->category_id==1)
            {
                $check =1;
            }
            $saleitem->product_id = $item['product_id'];
            $saleitem->quantity = $item['quantity'];
            $saleitem->rate = $item['rate'];
            $saleitem->total=$saleitem->quantity * $saleitem->rate;

            //Product table quantity updation (only sale category)
            if ($saleitem->category_id == 1) {
                $product = Product::FindOrFail($saleitem->product_id);
                $product->quantity = $product->quantity - $saleitem->quantity;
                $product->save();
            }

            if($request->gst_bill==0)
            {
                //finding total_rate by multiplying quantity and rate
                $saleitem->total_rate =  $saleitem->total;


            }
            else{
                $saleitem->discount = $item['discount'];
                $saleitem->gross_amount = $saleitem->total - $saleitem->discount;
                $saleitem->gst = $item['gst'];
                $gst_tax=$saleitem->gross_amount-$saleitem->gross_amount*100/(100+$saleitem->gst);
                $saleitem->taxable_amount=$saleitem->gross_amount-$gst_tax;
                $saleitem->cgst= $gst_tax/2.0;
                $saleitem->sgst= $gst_tax/2.0;
                $saleitem->total_rate =  $saleitem->taxable_amount+$gst_tax;
                $total_discount =  $total_discount + $saleitem->discount;
                $total_gst = $total_gst+$gst_tax;
                $total_taxable_amount= $total_taxable_amount+ $saleitem->taxable_amount;
            }


            //finding total amount by adding total_rate of each item
            if($request->gst_bill==0)
            {
                $total_amount = $total_amount + $saleitem->total_rate;
            }
            else
            {
                $total_amount = $total_amount + $saleitem->total;
            }


            $saleitem->save();
        }

        $sale->total_amount =  $total_amount;
        if($request->gst_bill==0){
            $sale->total_discount = $request->total_discount;
        }

        else
        {
            $sale->total_discount=$total_discount;
        }

        $sale->total_taxable_amount=$total_taxable_amount;
        $sale->total_cgst=$total_gst/2.0;
        $sale->total_sgst=$total_gst/2.0;

        //finding payable amount
        $sale->pay_amount = $sale->total_amount - $sale->total_discount;

        //finding reward points
        if($check==1)
            $reward_points = $sale->pay_amount * 0.0025;
        else
            $reward_points = $sale->pay_amount * 0.01;

        $sale->reward_points = $reward_points;

        //updating reward points in customer_rewards table
        $customer_reward = new CustomerReward;
        $customer_reward->user_id = Auth::user()->id;

        if($request->customer_id)
        $customer_reward->customer_id = $request->customer_id;
    else
    {
        $customer_reward->customer_id =  $new_customer->id;

    }



        $customer_reward->type = "CREDIT";
        $customer_reward->points = $reward_points;
        $customer_reward->invoice_no = $invoice_no;
        $customer_reward->remarks = "SALE REWARDS";
        $customer_reward->save();

        //updating customer_credits table if bill type is CREDIT
        if ($request->bill_type == 1) {
            $customer_credit = new CustomerCredit;
            $customer_credit->user_id = Auth::user()->id;

            if($request->customer_id)
             $customer_credit->customer_id = $request->customer_id;
        else
        {
             $customer_credit->customer_id =  $new_customer->id;

        }


            $customer_credit->invoice_no = $invoice_no;
            $customer_credit->amount = $sale->pay_amount;
            $customer_credit->remarks = "CREDIT SALE";
            $customer_credit->save();
        }
        else{

            $payment = new Payment;
            if ($request->date)
                $payment->payment_date = $request->date;
            else
                $payment->payment_date = date('Y-m-d');

            $payment->credit = 0;
            $payment->user_id = Auth::user()->id;
            $payment->invoice_no = $invoice_no;



            if($request->customer_id)
            $payment->customer_id = $request->customer_id;
       else
       {
            $payment->customer_id =  $new_customer->id;

       }


            $payment->amount = $sale->pay_amount;
            if($request->pay_type)
                $payment->pay_type=$request->pay_type;
            else
                $payment->pay_type="Cash";
            $payment->save();
        }
        $sale->save();
            if($saleitem->save() && $sale->save()){
                return ["invoice_no"=>$invoice_no,"date"=>$sale->invoice_date];
            }


        // return 'Success';
    }


    public function deleteSale(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $sale = Sale::FindOrFail($request->id);
        $saleitems = SaleItem::where('sale_id', $sale->invoice_no)->get();

        foreach ($saleitems as $saleitem) {

            //updating quantity under product table
            if ($saleitem->category_id == 1) {
                $product = Product::FindOrFail($saleitem->product_id);
                if($product)
                {
                    $product->quantity = $product->quantity + $saleitem->quantity;
                    $product->save();
                }
                else
                    return "Error";

            }

            //deleting saleitem one by one
            $saleitem->delete();
        }

        //deleting reward points entry in ustomer_rewards table
        $customer_reward = CustomerReward::where('invoice_no', $sale->invoice_no)->first();
        $customer_reward->delete();

        //deleting from Credit Table
        if ($sale->bill_type == 1) {
            $customer_credit = CustomerCredit::where('invoice_no', $sale->invoice_no)->first();
            $customer_credit->delete();
        }


        //deleting sale entry
        $sale->delete();
        return 'Success';
    }


    public function getSales(Request $request)
    {
        $sales =  Sale::with('items', 'customer');


        if ($request->from_date) {

            $sales->where('invoice_date', '>=', $request->from_date);
        }
        if ($request->to_date) {

            $sales->where('invoice_date', '<=', $request->to_date);
        }
        // if(!$request->from_date && !$request->to_date)
        // {
        //     $sales->where('invoice_date', '=',Carbon::today());
        // }

        return $sales->orderBy('id', 'desc')->get();
    }


    public function getTodaySales(Request $request)
    {
        $sales =  Sale::with('items', 'customer')->whereDate('created_at', '=', Carbon::today())->orderBy('id', 'desc')->get();


        return $sales;
    }
}
