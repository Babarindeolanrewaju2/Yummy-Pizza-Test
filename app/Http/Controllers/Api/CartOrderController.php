<?php

namespace App\Http\Controllers\Api;

use App\CartOrders;
use App\Http\Controllers\Controller;
use App\Http\Resources\PizzaApiResource;
use App\Http\Resources\PizzaOrderResource;
use Illuminate\Http\Request;

class CartOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PizzaOrderResource::collection(CartOrders::all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pizza_order = new CartOrders;
        $pizza_order->name = $request->name;
        $pizza_order->email = $request->email;
        $pizza_order->address = $request->address;
        $pizza_order->location = $request->location;
        $pizza_order->phone = $request->phone;
        $pizza_order->save();
        return new PizzaOrderResource($pizza_order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cartOrders = CartOrders::findOrFail($id);
        return new PizzaOrderResource($cartOrders);
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
        $cartOrder = CartOrders::findOrFail($id);
        $cartOrder->update($request->only('name','email','location','phone'));
        return new PizzaOrderResource($cartOrder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartOrder = CartOrders::findOrFail($id);
        $cartOrder->delete();
        //return  new PizzaOrderResource($cartOrder);
        return response()->json("Order item successfully delete");

    }
}
