<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Coupon;
use App\Order;
use App\Orderitem;

class CustomerOrdersController extends Controller
{
  public function index()
  {
      return view('customerOrders.customerOrders');
  }

  public function getProducts()
  {
    $products = Product::All();
    return $products;
  }

  public function checkCoupon($coupon){
    //$result = Coupon::where('code', '=', ''+$coupon)->where('available', '=', 1);
    $result = Coupon::get()->where('code', '=', $coupon)->where('available', '=', 1)->first();
    return $result;
  }

  public function submitOrder(Request $request){
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $ret = null;
    foreach ($request as $req) {
      $items = $req->items;

      $order = new Order;
      $order->coupon_id = $req->couponId;
      $order->totalPrice = $req->totalPrice;

      $order->save();

      $orderId = $order->id;

      foreach ($items as $item) {
        $list = new Orderitem;
        $list->product_id = $item->id;
        $list->order_id = $orderId;
        $list->qty = $item->qty;
        $list->totalItemPrice = $item->totalPrice;

        $list->save();

        $ret = (string)$item->totalPrice;
      }
      //
    }
    return $ret;
  }
}
