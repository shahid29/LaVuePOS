<?php

namespace App\Http\Controllers\Api;

use App\Model\Product;
use App\Model\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function paySalary(Request $request,$id){

        $validatedData = $request->validate([
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = Salary::where('employee_id',$id)->where('salary_month',$month)->first();
        if ($check){
        }else{
            $salaryP = new Salary();
            $salaryP->employee_id = $id;
            $salaryP->amount = $request->salary;
            $salaryP->salary_date = date('d/m/Y');
            $salaryP->salary_month = $request->salary_month;
            $salaryP->salary_year = date('Y');
            $salaryP->save();
        }
    }

    public function allSalary(){
        $salary = Salary::select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }

    public function allMonthSalary($id){

        $salaryId = $id;
        $salary = Salary::with('employee')->where('salary_month',$salaryId)->get();
        return response()->json($salary);
//        $month = $id;
//        $salary = DB::table('salaries')->where('salary_month',$month)->get();
//        return response()->json($salary);



    }

    public function editSalary($id){
        $view=DB::table('salaries')
            ->join('employees','salaries.employee_id','employees.id')
            ->select('employees.name','employees.phone','salaries.*')
            ->where('salaries.id',$id)
            ->first();
        return response()->json($view);
    }

    public function updateSalary(Request $request,$id){

        $validatedData = $request->validate([
            'salary_month' => 'required',
        ]);


            $salaryP= Salary::find($id);
            $salaryP->employee_id = $request->employee_id;
            $salaryP->amount = $request->amount;
            $salaryP->salary_date = date('d/m/Y');
            $salaryP->salary_month = $request->salary_month;
            $salaryP->salary_year = date('Y');
            $salaryP->save();

    }

    public function updateStock(Request $request,$id){

        $validatedData = $request->validate([
            'product_quantity' => 'required',
        ]);

        $product = Product::find($id);
        $product->product_quantity = $request->product_quantity;
        $product->save();
    }


}
