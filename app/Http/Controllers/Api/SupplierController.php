<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
use Image;

class SupplierController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Supplier::all());
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
            'name'=>'required|max:255',
            'email' => 'required|email|unique:suppliers',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $supplier = new Supplier;
        if($request->photo){
            // $position = strpos($request->photo, ';');
            // $sub = substr($request->photo, 0, $position);
            // $ext = explode('/', $sub)[1];
            //for my method
            $i =  Image::make($request->photo)->mime();
            $ext = explode('/', $i)[1];
            $name = time().".".$ext;

            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $supplier->photo = $image_url;
        }

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shopname = $request->shopname;
        $supplier->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Supplier::findOrFail($id));
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
        $supplier =  Supplier::findOrFail($id);
        if($request->photo){
            // $position = strpos($request->photo, ';');
            // $sub = substr($request->photo, 0, $position);
            // $ext = explode('/', $sub)[1];
            //for my method
            $i =  Image::make($request->photo)->mime();
            $ext = explode('/', $i)[1];
            $name = time().".".$ext;

            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            //$img->save($image_url) ;
            if($img->save($image_url)){
                $oldImagePath = $supplier->photo;
                unlink($oldImagePath);
                $supplier->photo = $image_url;
            }
        }

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shopname = $request->shopname;
        $supplier->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        if($supplier->photo){
            unlink($supplier->photo);
        }
        Supplier::where('id', $id)->delete();
    }
}
