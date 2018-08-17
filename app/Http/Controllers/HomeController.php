<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Coupon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = Coupon::All()->count();
        $product = Product::All()->count();
        $orderDone = Order::All()->where('done', 1)->count();
        $orderPending = Order::All()->where('done', 0)->count();
        return view('home', compact('coupon', 'product', 'orderDone', 'orderPending'));
    }
}
