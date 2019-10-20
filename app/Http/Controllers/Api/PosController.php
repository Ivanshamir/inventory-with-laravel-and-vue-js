<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Pos;
use DB;

class PosController extends Controller
{
    public function getProduct($id)
    {
        $product = DB::table('products')
                    ->where('category_id', $id)
                    ->get();
        return response()->json($product);
    }

    public function orderdone(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'payby' => 'required'
        ]);

        $order_id = Order::create([
            'customer_id' => $request->customer_id,
            'qty' => $request->qty,
            'sub_total' => $request->subtotal,
            'vat' => $request->vat,
            'total' => $request->total,
            'payby' => $request->payby,
            'pay' => $request->pay,
            'due' => $request->due,
            'order_date' => date('d/m/Y'),
            'order_month' => date('F'),
            'order_year' => date('Y')
        ]);

        $contents = Pos::all();
        foreach($contents as $content){
            OrderDetail::create([
                'order_id' =>  $order_id->id,
                'product_id' => $content->pro_id,
                'pro_quantity' => $content->pro_quantity,
                'product_price' => $content->product_price,
                'sub_total' => $content->sub_total
            ]);
            
            DB::table('products')
                ->where('id', $content->pro_id)
                ->update(['product_quantity' => DB::raw('product_quantity -'.$content->pro_quantity)]);
        }

        Pos::truncate();
        return response('done');
    }
}
