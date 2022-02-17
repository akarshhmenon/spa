<?php

namespace App\Http\Controllers;

use App\Models\ProductAndService;
use App\Models\Purchase;
use App\Models\Purchase_item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function addPurchase(Request $request)
    {



        $request->validate([

            // 'name' => "required|min:3|max:255",
            // 'email' => "required|email|unique:employees,email,$request->id",
            // 'mobile' => "required|min:10|max:10|unique:employees,mobile,$request->id"
        ]);



        if ($request->id) {

            $Purchase = Purchase::find($request->id);
            $Purchase_item = Purchase_item::where('purchase_id', '=', $Purchase->id)->get();


            foreach ($Purchase_item as $item) {

                $product = ProductAndService::where('id', '=', $item['product_id'])->first();
                $product->quantity = $product->quantity - $item['purchase_qty'];

                $product->save();

                $item->delete();
            }
        } else

            $Purchase = new Purchase;
        $Purchase->user_id = Auth::user()->id;
        $Purchase->vendor_id = $request->vendor_id;
        $Purchase->purchase_date = $request->purchasedate;
        $Purchase->purchase_invoice_no = $request->purchase_invoice_no;
        $Purchase->remarks = $request->remarks;



        $Purchase->total_products = count($request->items);


        $Purchase->total_amount = $request->total_amount;
        $Purchase->save();

        foreach ($request->items as $item) {

            $Purchase_item = new Purchase_item;
            $Purchase_item->purchase_id = $Purchase->id;
            $Purchase_item->product_id = $item['product_id'];
            $Purchase_item->purchase_qty = $item['purchase_qty'];
            $Purchase_item->rate_per_qty = $item['rate_per_qty'];
            $Purchase_item->total_tax_amount = $item['total_tax_amount'];
            $Purchase_item->gst_percentage = $item['gst_percentage'];
            $Purchase_item->amount = $item['amount'];
            $Purchase_item->save();

            $product = ProductAndService::find($item['product_id']);
            $product->quantity = $product->quantity + $item['purchase_qty'];
            $product->save();
        }





        return 'success';
    }


    public function getPurchases()
    {


        return Purchase::with('vendors', 'purchase_items')->orderBy('id', 'desc')->get();
    }


    public function deletePurchase(Request $request)
    {
        if ($request->id) {

            $Purchase = Purchase::find($request->id);
            $Purchase_item = Purchase_item::where('purchase_id', '=', $Purchase->id)->get();


            foreach ($Purchase_item as $item) {

                $product = ProductAndService::where('id', '=', $item['product_id'])->first();
                $product->quantity = $product->quantity - $item['purchase_qty'];

                $product->save();

                $item->delete();
            }

            $Purchase->delete();
        }
    }


public function getPurchaseReport(Request $request){

    $purchase = Purchase::with('vendors', 'purchase_items')->orderBy('id', 'desc');

    if ($request->from_date) {

        $purchase->where('purchase_date', '>=', $request->from_date);
    }
    if ($request->to_date) {

        $purchase->where('purchase_date', '<=', $request->to_date);
    }
    if (!$request->from_date && !$request->to_date) {
        $purchase->where('purchase_date',  Carbon::now()->toDateString());
    }

    return $purchase->get();

}


}
