<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Image;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('suppliers', 'products.supplier_id', 'suppliers.id')
                    ->select('categories.name as category_name', 'suppliers.name as supplier_name', 'products.*')
                    ->orderBy('products.id', 'DESC')
                    ->get();

        return response()->json($products);
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
        $request->validate([
            'product_name'=>'required|max:255',
            'product_code'=>'required|unique:products',
            'selling_price'=>'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'product_quantity' => 'required'
        ]);

        $product = new Product;
        if($request->image){
            $i =  Image::make($request->image)->mime();
            $ext = explode('/', $i)[1];
            $name = time().".".$ext;

            $img = Image::make($request->image)->resize(240, 200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $product->image = $image_url;
        }

        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->supplier_id = $request->supplier_id;
        $product->buying_date = $request->buying_date;
        $product->product_quantity = $request->product_quantity;
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Product::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $product =  Product::findOrFail($id);
        if($request->new_image){
            $i =  Image::make($request->new_image)->mime();
            $ext = explode('/', $i)[1];
            $name = time().".".$ext;

            $img = Image::make($request->new_image)->resize(240, 200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            //$img->save($image_url) ;
            if($img->save($image_url)){
                $oldImagePath = $product->image;
                unlink($oldImagePath);
                $product->image = $image_url;
            }
        }

        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->supplier_id = $request->supplier_id;
        $product->buying_date = $request->buying_date;
        $product->product_quantity = $request->product_quantity;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        if($product->image){
            unlink($product->image);
        }
        $product->delete();
    }

    public function stockupdate(Request $request, $id)
    {
        $request->validate([
            'product_quantity' => 'required'
        ]);

        $product = Product::findOrFail($id);
        $product->product_quantity = $request->product_quantity;
        $product->save();
    }
}
