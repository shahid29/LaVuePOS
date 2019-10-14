<?php

namespace App\Http\Controllers\Api;

use App\Model\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allEmployee = Employee::orderBy('id', 'desc')->get();
        return response()->json($allEmployee);
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:employees|max:255',
            'phone' => 'required|unique:employees',
            'address' => 'required',
            'salary' => 'required',
            'nid' => 'required',
            'joinning_date' => 'required',
        ]);
        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub=substr($request->photo, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($request->photo)->resize(240,200);
            $upload_path='backend/employee/';
            $image_url=$upload_path.$name;
            $img->save($image_url);

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->joinning_date = $request->joinning_date;
            $employee->nid = $request->nid;
            $employee->phone = $request->phone;
            $employee->photo =  $image_url;
            $employee->save();
        }else{
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->joinning_date = $request->joinning_date;
            $employee->nid = $request->nid;
            $employee->phone = $request->phone;
            $employee->save();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Employee::find($id);
//        $show = DB::table('employees')->where('id',$id)->first();
        return response()->json($show);

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

        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'nid' => 'required',
            'joinning_date' => 'required',
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['salary']=$request->salary;
        $data['nid']=$request->nid;
        $data['joinning_date']=$request->joinning_date;
        $image=$request->newphoto; //n
        if ($image) {
            $position = strpos($image, ';');
            $sub=substr($image, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($image)->resize(240,200);
            $upload_path='backend/employee/';
            $image_url=$upload_path.$name;
            $success=$img->save($image_url);
            if  ($success) {
                $data['photo']=$image_url;
                $img=DB::table('employees')->where('id',$id)->first();
                $image_path = $img->photo;
                $done=unlink($image_path);
                $user=DB::table('employees')->where('id',$id)->update($data);
            }
        }else{
            $prePhoto = Employee::find($id);
            $name = $prePhoto->photo;

            $employe = Employee::find($id);
            $employe->name = $request->name;
            $employe->email = $request->email;
            $employe->phone = $request->phone;
            $employe->address = $request->address;
            $employe->salary = $request->salary;
            $employe->nid = $request->nid;
            $employe->joinning_date = $request->joinning_date;
            $employe->photo = $name;
            $employe->save();


//            $data['photo']=$oldlogo;
//            DB::table('employees')->where('id',$id)->update($data);
//            $prePhoto->save();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = Employee::find($id);
        $path = $delete->photo;
        if ($path){
            unlink($path);
            $delete = Employee::find($id);
            $delete->delete();
        }else{
            $delete = Employee::find($id);
            $delete->delete();
        }
    }
}
