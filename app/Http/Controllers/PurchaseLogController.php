<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseLog;
use App\Models\PurchaseItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseLogController extends Controller
{
    public function save(Request $request)
    {

        foreach ($request->items as $item){
           if( $item['product_id'] == null || $item['purchase_qty'] == null){
                return 'items_error';
           }
        }

           if($request->items==[]){
               return "items_array_error";
           }

        $request->validate([

            'purchase_invoice_no' => 'required',
            'purchase_date'=>'required',

        ]);



        if($request->id)
        {
            $purchase_log = PurchaseLog::FindOrFail($request->id);

            $purchase_items=PurchaseItem::where('purchase_id',$purchase_log->id)->get();

            foreach($purchase_items as $purchase_item){

            //updating quantity under product table

                $product= Product::FindOrFail($purchase_item->product_id);
                $product->quantity = $product->quantity - $purchase_item->purchase_qty;
                $product->save();


                //deleting purchase item one by one
                $purchase_item->delete();
            }

        }
        else
        {
            $purchase_log = new PurchaseLog;
        }
        $last_record=PurchaseLog::all();
        $last_record_id=PurchaseLog::latest()->first();

        if($last_record->isEmpty()){
            $purchase_log_id=1;
        }
        else if($request->id){

            $purchase_log_id=$request->id;
        }
        else $purchase_log_id=$last_record_id->id+1;

        $purchase_log->user_id = Auth::user()->id;
        $purchase_log->purchase_invoice_no = $request->purchase_invoice_no;
        $purchase_log->purchase_date = $request->purchase_date;
        $purchase_log->remarks = $request->remarks;

        //finding total products and purchase quantities
        $total_products=0;
        $total_qty=0;
        $total_amount=0;
        $total_tax=0;
        $total_taxable_amount=0;

        foreach ($request->items as $item){


            $purchase_item = new PurchaseItem;



            $purchase_item->purchase_id= $purchase_log_id;
            $purchase_item->product_id=$item['product_id'];
            // $purchase_item->product_id=2;
            $purchase_item->purchase_qty=$item['purchase_qty'];
            $purchase_item->rate_per_qty=$item['rate_per_qty'];
            $purchase_item->gst_percentage=$item['gst_percentage'];
            $purchase_item->taxable_amount=$item['taxable_amount'];
            $purchase_item->tax=$item['tax'];
            $purchase_item->amount=$item['amount'];




            //Product table quantity updation
            $product= Product::FindOrFail($purchase_item->product_id);
            $product->quantity = $product->quantity + $purchase_item->purchase_qty;
            $product->save();


            //addition to find total products and purchase quantities
            $total_products=$total_products+1;
            $total_qty=$total_qty+$purchase_item->purchase_qty;
            if($purchase_item->tax)
                $total_tax=$total_tax+$purchase_item->tax;
            if($purchase_item->amount)
                $total_amount=$total_amount+$purchase_item->amount;
            if($purchase_item->taxable_amount)
                $total_taxable_amount=$total_taxable_amount+$purchase_item->taxable_amount;
            $purchase_item->save();
        }

        $purchase_log->total_products = $total_products;
        $purchase_log->total_qty = $total_qty;

        $purchase_log->save();
        return 'success';
    }

    public function getPurchases(Request $request)
    {

        $purchaselogs =  Purchaselog::with('purchaseItems');

        if ($request->from_date) {

            $purchaselogs->where('purchase_date', '>=', $request->from_date);
        }
        if ($request->to_date) {

            $purchaselogs->where('purchase_date', '<=', $request->to_date);
        }
        // if(!$request->from_date && !$request->to_date)
        // {
        //     $purchaselogs->where('purchase_date', '=',Carbon::today());
        // }

        return $purchaselogs->orderBy('id', 'desc')->get();
    }

    public function getTodayPurchases(Request $request)
    {
        $today_purchase =  PurchaseLog::with('purchaseItems')->whereDate('created_at', '=', Carbon::today())->orderBy('id', 'desc')->get();


        return $today_purchase;
    }

    public function deletePurchase(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $purchase_log = PurchaseLog::FindOrFail($request->id);
        $purchase_items=PurchaseItem::where('purchase_id',$purchase_log->id)->get();

        foreach($purchase_items as $purchase_item){

            //updating quantity under product table

            $product= Product::FindOrFail($purchase_item->product_id);
            $product->quantity = $product->quantity - $purchase_item->purchase_qty;
            $product->save();


            //deleting purchase item one by one
            $purchase_item->delete();
        }

        //deleting purchase entry
        $purchase_log->delete();
        return 'Success';
    }
}
