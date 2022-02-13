<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Purchase_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function addPurchase(Request $request)
    {

        foreach ($request->items as $item) {
            if ($item['purchase_qty'] == null) {
                return 'items_error';
            }
        }

        if ($request->items == []) {
            return "items_array_error";
        }

        $request->validate([

            // 'name' => "required|min:3|max:255",
            // 'email' => "required|email|unique:employees,email,$request->id",
            // 'mobile' => "required|min:10|max:10|unique:employees,mobile,$request->id"
        ]);


        if ($request->id) {

            $Purchase = Purchase::find($request->id);
            $purchase_items = PurchaseItem::where('purchase_id', $purchase->id)->get();
        } else

            $Purchase = new Purchase;
        $Purchase->user_id = Auth::user()->id;
        $Purchase->vendor_id = $request->vendor_id;
        $Purchase->bill_type = $request->billtype;
        $Purchase->purchase_date= $request->purchasedate;
        $Purchase->pay_type = $request->paytype;
        $Purchase->purchase_invoice_no = $request->purchase_invoice_no;
        $Purchase->total_products = $request->totalproduct;
        $Purchase->total_qty = $request-> totalquantity;
        $Purchase->total_taxable_amount = $request->totaltaxableamount;
        $Purchase->total_tax = $request->totaltax;
        $Purchase->total_amount = $request->totalamount;
        $Purchase->remarks = $request->remarks;
        $Purchase->save();
        $Purchase_item = new Purchase_item;
        $purchase_item->purchase_qty = $item['purchase_qty'];
            $purchase_item->rate_per_qty = $item['rate_per_qty'];
            $purchase_item->gst_percentage = $item['gst_percentage'];
            $purchase_item->taxable_amount = $item['taxable_amount'];
            $purchase_item->tax = $item['tax'];
            $purchase_item->amount = $item['amount'];
            $purchase_item->created_at = $request->purchase_date;

            //Product table quantity updation
            $product = Product::FindOrFail($purchase_item->product_id);
            $product->quantity = $product->quantity + $purchase_item->purchase_qty;
            $product->save();


        return 'success';
    }


    public function getPurchases()
    {


        return Purchase::with('vendors')-> orderBy('id','desc')->get();
    }


    public function deletePurchase(Request $request)
    {
        if ($request->id) {
            $Purchase= Purchase::find($request->id);
            $Purchase->delete();
            return 'success';
        } else {

            return "failed";
        }
    }

}
