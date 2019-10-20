<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
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
            'name'=>'required|unique:employees|max:255',
            'email' => 'required|email',
            'salary' => 'required',
            'address' => 'required',
            'joining_date' => 'required'
        ]);

        $employee = new Employee;
        if($request->photo){
            // $position = strpos($request->photo, ';');
            // $sub = substr($request->photo, 0, $position);
            // $ext = explode('/', $sub)[1];
            //for my method
            $i =  Image::make($request->photo)->mime();
            $ext = explode('/', $i)[1];
            $name = time().".".$ext;

            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $employee->photo = $image_url;
        }

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $employee->nid = $request->nid;
        $employee->joining_date = $request->joining_date;
        $employee->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Employee::findOrFail($id));
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
        $employee =  Employee::findOrFail($id);
        if($request->photo){
            // $position = strpos($request->photo, ';');
            // $sub = substr($request->photo, 0, $position);
            // $ext = explode('/', $sub)[1];
            //for my method
            $i =  Image::make($request->photo)->mime();
            $ext = explode('/', $i)[1];
            $name = time().".".$ext;

            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            //$img->save($image_url) ;
            if($img->save($image_url)){
                $oldImagePath = $employee->photo;
                unlink($oldImagePath);
                $employee->photo = $image_url;
            }
        }

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $employee->nid = $request->nid;
        $employee->joining_date = $request->joining_date;
        $employee->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->first();
        if($employee->photo){
            unlink($employee->photo);
        }
        Employee::where('id', $id)->delete();
    }
}
