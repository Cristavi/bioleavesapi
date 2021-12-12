<?php

namespace App\Http\Controllers\DeliveredProduct;

use App\Http\Controllers\Controller;
use App\Models\DeliveredProduct;
use App\Models\Order;
use Illuminate\Http\Request;


class DeliveredProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveredProduct = DeliveredProduct::latest()->with([ 'product'])->where('user_id', '=', auth()->user()->id)->get();

        return response($deliveredProduct, 200);
    }

    public function getAllOrders(){
        $order = Order::latest()->with([ 'product', 'user'])->get();

        return response($order);
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
    public function store(Request $request, $id)
    {
        $order = Order::find($id);

        $deliveredProduct = DeliveredProduct::create([
            "user_id" => $order->user_id,
            "product_id" => $order->product_id,
            "quantity" => $order->quantity
        ]);

        Order::destroy($id);

        return response([
            "delivered_product" => $deliveredProduct
        ], 201);
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deliveredProduct = DeliveredProduct::find($id);

        DeliveredProduct::destroy($id);

        return ([
            "destroyed" => $deliveredProduct
        ]);
    }
}
