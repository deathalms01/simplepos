<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = DB::table('orders')->orderBy('orders.id', 'desc')
          ->leftjoin('orderitems', 'orders.id', '=', 'orderitems.order_id')
          ->leftjoin('products', 'orderitems.product_id', '=', 'products.id')
          ->leftjoin('coupons', 'orders.coupon_id', '=', 'coupons.id')
          ->select('orders.id as orderid', 'products.description as description',
          'products.type as type',
          'products.price as productprice', 'orderitems.qty as qty',
          'orderitems.totalItemPrice as producttotal',
          'coupons.code as coupon','coupons.discount as discountpercent',
          'orders.totalPrice as grosstotal', 'orders.done as done',
          DB::raw('orders.totalPrice-(orders.totalPrice*coupons.discount)
          as discountedprice'))
           ->paginate(10);



      return view('orders.orders', compact('data'));
      //return $data;
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
    public function store(Request $request)
    {
        //
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
      $order = Order::findOrFail($id);
      $order->done = true;
      $order->update();
      //return $order;
      return redirect('orders');
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
        //
    }
}
