<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ProductAndService;
use App\Models\Sale;
use App\Models\SaleItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function addSale(Request $request)
    {





        $request->validate([

            'customer_id' => "required",
            'pay_type' => "required",

        ]);




        if ($request->id) {

            $sale = Sale::find($request->id);
            $sale_item = SaleItem::where('sale_id', '=', $sale->id)->get();


            foreach ($sale_item as $item) {

                $product = ProductAndService::where('id', '=', $item['product_id'])->first();
                $product->quantity = $product->quantity + $item['quantity'];

                $product->save();

                $item->delete();
            }

$payment =Payment::where('sale_id','=',$sale->id)->first();
$payment->delete();


        } else

            $sale = new Sale;
        $sale->user_id = Auth::user()->id;
        $sale->customer_id = $request->customer_id;
        $sale->invoice_date = $request->invoice_date;
        $sale->total_taxable_amount = $request->total_taxable_amount;
        $sale->total_cgst = $request->total_taxable_amount / 100;
        $sale->total_sgst = $request->total_taxable_amount / 100;
        $sale->total_cess = 0;

        $sale->total_amount = $request->total_amount;
        $sale->total_discount = $request->total_discount;
        $sale->total_pay_amount = $request->total_pay_amount;
        $sale->pay_type = $request->pay_type;
        $sale->save();

        foreach ($request->items as $item) {

            $sale_item = new SaleItem;
            $sale_item->user_id = Auth::user()->id;
            $sale_item->sale_id = $sale->id;
            $sale_item->product_id = $item['product_id'];
            $sale_item->product_name = $item['product_name'];

            $sale_item->quantity = $item['quantity'];
            $sale_item->rate = $item['rate'];
            $sale_item->total_rate = $item['total_rate'];
            $sale_item->taxable_value = $item['taxable_value'];
            $sale_item->gst = $item['gst'] / 2;
            $sale_item->cgst = $item['taxable_value'] / 2;
            $sale_item->sgst = $item['taxable_value'] / 2;
            $sale_item->cess = 0;
            $sale_item->net_total = $item['net_total'];
            $sale_item->save();


            $product = ProductAndService::find($item['product_id']);
            $product->quantity = $product->quantity - $item['quantity'];
            $product->save();
        }


        $payment = new Payment;

        $payment->customer_id = $request->customer_id;

        $payment->sale_id = $sale->id;
        $payment->total_price = $request->total_amount;
        $payment->total_discount = $request->total_discount;
        $payment->payable_amount = $request->total_pay_amount;

        $payment->date = Carbon::now()->toDateString();
        $payment->type   = $request->pay_type;

        $payment->save();

       
        $message = [

            'message' => 'success',
            'id' => $payment->id,

        ];


        return [
            'return' => $message,
        ];
    }
    public function getSales()
    {

        return Sale::with('customer', 'sale_items')->orderBy('id', 'desc')->get();
    }
    public function deleteSale(Request $request)
    {


        if ($request->id) {

            $sale = Sale::find($request->id);
            $sale_item = SaleItem::where('sale_id', '=', $sale->id)->get();


            foreach ($sale_item as $item) {

                $product = ProductAndService::where('id', '=', $item['product_id'])->first();
                $product->quantity = $product->quantity + $item['quantity'];

                $product->save();

                $item->delete();
            }

            $sale->delete();

            return 'success';
        }
    }



    public function getSalesReport(Request $request){

        $sales = Sale::with('customer', 'sale_items')->orderBy('id', 'desc');
    
        if ($request->from_date) {
    
            $sales->where('invoice_date', '>=', $request->from_date);
        }
        if ($request->to_date) {
    
            $sales->where('invoice_date', '<=', $request->to_date);
        }
        if (!$request->from_date && !$request->to_date) {
            $sales->where('invoice_date',  Carbon::now()->toDateString());
        }
    
        return $sales->get();
    
    }

}
