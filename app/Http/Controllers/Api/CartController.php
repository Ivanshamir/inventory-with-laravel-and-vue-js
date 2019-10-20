<?php

namespace App\Http\Controllers\Api;

use App\Extra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pos;
use App\Product;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $check = Pos::where('pro_id', $id)->first();

        if($check){
            Pos::where('pro_id', $id)->increment('pro_quantity');

            $pos = Pos::where('pro_id', $id)->first();
            $result = $pos->pro_quantity * $pos->product_price;
    
            $pos->sub_total = $result;
            $pos->save();
        }else{
            Pos::create([
                'pro_id' => $id,
                'pro_name' => $product->product_name,
                'pro_quantity' => 1,
                'product_price' => $product->selling_price,
                'sub_total' => $product->selling_price
            ]);
        }

    }


    public function CartProduct()
    {
       return response()->json(Pos::all());
    }

    public function removeCart($id)
    {
       Pos::findOrFail($id)->delete();
    }

    public function increment($id)
    {
        Pos::where('id', $id)->increment('pro_quantity');

        $pos =  Pos::where('id', $id)->first();

        $result = $pos->pro_quantity * $pos->product_price;

        $pos->sub_total = $result;
        $pos->save();
    }

    public function decrement($id)
    {
        Pos::where('id', $id)->decrement('pro_quantity');

        $pos =  Pos::where('id', $id)->first();

        $result = $pos->pro_quantity * $pos->product_price;

        $pos->sub_total = $result;
        $pos->save();
    }

    public function vats()
    {
        return response()->json(Extra::first());
    }
}
