<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.products', compact('products'));
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
          'description' => 'required|max:255',
          'price' => 'required|numeric',
          'imglink' => 'file',
          'type' => 'required',
          'qty' => 'required|numeric',
        ]);


        if($request->hasFile('imglink')){
      		$avatar = $request->file('imglink');
      		$filename = time(). '.' . $avatar->getClientOriginalExtension();
      		Image::make($avatar)->resize(300, 300)->save( public_path('/img/' . $filename ) );

          $products = new Product;

          $products->description = $request->description;
      		$products->price = $request->price;
          $products->type = $request->type;
          $products->qty = $request->qty;
          $products->imglink = $filename;


          $products->save();
    	  }
        //return $products;
        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product = Product::whereId($id)->first();
      return view('products.productEdit', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product = Product::whereId($id)->first();
      return view('products.productEdit', compact('product'));
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
      $product = Product::findOrFail($id);

      $product->description = $request->description;
      $product->price = $request->price;
      $product->type = $request->type;
      $product->qty = $request->qty;

      if($request->hasFile('imglink')){
        $avatar = $request->file('imglink');
        $filename = time(). '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save( public_path('/img/' . $filename ) );

        $product->imglink = $filename;
      }

      $product->update();

      //$product = Product::paginate(10);
      //return view('products.products', compact('products'));
      return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product = Product::findOrFail($id);
      $product->delete();

      return redirect('products');
        return $id;
    }
}
