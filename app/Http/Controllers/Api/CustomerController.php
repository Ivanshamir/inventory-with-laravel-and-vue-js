<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Customer::all());
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
            'phone'=>'required|unique:customers',
            'address'=>'required'
        ]);

        $customer = new Customer;
        if($request->photo){
            $i =  Image::make($request->photo)->mime();
            $ext = explode('/', $i)[1];
            $name = time().".".$ext;

            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $customer->photo = $image_url;
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Customer::findOrFail($id));
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
        $customer =  Customer::findOrFail($id);
        if($request->new_photo){
            $i =  Image::make($request->new_photo)->mime();
            $ext = explode('/', $i)[1];
            $name = time().".".$ext;

            $img = Image::make($request->new_photo)->resize(240, 200);
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            //$img->save($image_url) ;
            if($img->save($image_url)){
                $oldImagePath = $customer->photo;
                unlink($oldImagePath);
                $customer->photo = $image_url;
            }
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::where('id', $id)->first();
        if($customer->photo){
            unlink($customer->photo);
        }
        $customer->delete();
    }
}
