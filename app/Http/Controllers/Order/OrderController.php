<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $order = Order::latest()->with([ 'product'])->where('user_id', '=', auth()->user()->id)->get();

        return response($order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request, Product $product)
    {
        $order = $product->order()->create([
            'user_id' => auth()->user()->id,
            'quantity' => $request->input('quantity')
        ]);

        return response($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        return ($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if($order->user_id != auth()->user()->id)
        {
            return response("asdasdasd");
        }

        $order->update([
           'quantity' => $request->input('quantity')
        ]);

        return response([
            "message" => "Updated order",
            "order" => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $order = Order::destroy($id);

        return ([
            "message" => "Deleted",
            "order" => $order
        ]);
    }
}
