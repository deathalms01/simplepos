<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $coupons = Coupon::paginate(10);
      //return $coupons;
      return view('coupons.coupons', compact('coupons'));
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
      $this->validate($request, [
        'code' => 'required|max:255',
        'discount' => 'required|numeric',
        'available' => 'required'
      ]);

      $coupon = new Coupon;

      $coupon->code = $request->code;
      $coupon->discount = $request->discount/100;

      if(!strcmp($request->available, "1")){
        $coupon->available = true;
      } else {
        $coupon->available = false;
      }

      $coupon->save();
      return redirect('coupons');
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
      $coupon = Coupon::whereId($id)->first();
      return view('coupons.couponsEdit', compact('coupon'));
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
        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->code;
        $coupon->discount = $request->discount/100;
        if(!strcmp($request->available, "1")){
          $coupon->available = true;
        } else {
          $coupon->available = false;
        }

        $coupon->update();
        return redirect('coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $coupon = Coupon::findOrFail($id);
      $coupon->delete();

      return redirect('coupons');
      //return $id;
    }
}
