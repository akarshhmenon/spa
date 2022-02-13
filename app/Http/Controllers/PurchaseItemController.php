<?php

namespace App\Http\Controllers;

use App\Models\Purchase_item;
use App\Http\Requests\StorePurchase_itemRequest;
use App\Http\Requests\UpdatePurchase_itemRequest;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePurchase_itemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchase_itemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase_item  $purchase_item
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase_item $purchase_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase_item  $purchase_item
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase_item $purchase_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchase_itemRequest  $request
     * @param  \App\Models\Purchase_item  $purchase_item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchase_itemRequest $request, Purchase_item $purchase_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase_item  $purchase_item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase_item $purchase_item)
    {
        //
    }
}
