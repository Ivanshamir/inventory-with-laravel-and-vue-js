<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Salary;
use DB;

class SalaryController extends Controller
{
    public function paid(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required',
            'salary_month' => 'required'
        ]);

        $result = Salary::where(['employee_id' => $id, 'salary_month' => $request->salary_month])->first();

        if($result){
            return response()->json('Salary already paid');
        }

        Salary::create([
            'employee_id' => $id,
            'amount' => $request->amount,
            'salary_date' => date('d-m-Y'),
            'salary_month' => $request->salary_month,
            'salary_year' => date('Y')
        ]);

    }

    public function allSalary()
    {
       $salary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();
       return response()->json($salary);
    }

    public function view($id)
    {
        $month = $id;
        $view = DB::table('salaries')
                ->join('employees', 'salaries.employee_id', 'employees.id')
                ->select('employees.name', 'salaries.*')
                ->where('salaries.salary_month', $month)
                ->get();
                return response()->json($view);
    }
}
