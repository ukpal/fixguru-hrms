<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentEmployee;
use App\Models\EmployeeDepartment;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{

    public function index()
    {
        return view('departments.index', [
            'depts' => DB::select('SELECT d.*,e.fname,e.lname FROM `departments` d left join employee_department ed on 
d.id=ed.department_id and ed.is_dept_head=1 left join employees e on ed.employee_id=e.id WHERE d.deleted_at IS NULL')
        ]);
    }

    public function create()
    {
        return view('departments.add', [
            'users' => DB::select("SELECT users.* from users JOIN roles on users.role_id=roles.id WHERE roles.name='HE User'")
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'dept_name' => 'required|alpha',
            'dept_name' => 'required|max:90',
            'desc' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $old_dept=DB::select("select id from departments where dept_name='".$request->dept_name."' AND deleted_at IS NULL");
        if($old_dept){
            return redirect()->back()->withErrors(['dept_name'=>'The dept name has already been taken.'])->withInput();
        }
        
        try {
            $dept = new Department();
            $dept->dept_name = $request->dept_name;
            $dept->description = $request->desc;
            $dept->created_by = Auth::user()->id;
            $dept->save();

            // if ($request->dept_head) {
            //     $old_dept_emp = DepartmentEmployee::where([['employee_id', '=', $request->dept_head], ['department_id', '=', $dept->id]])->first();
            //     if ($old_dept_emp) {
            //         $old_dept_emp->is_dept_head = 1;
            //         $old_dept_emp->created_by = Auth::user()->id;
            //         $old_dept_emp->save();
            //     } else {
            //         $dept_emp = new DepartmentEmployee();
            //         $dept_emp->employee_id = $request->dept_head;
            //         $dept_emp->department_id = $dept->id;
            //         $dept_emp->is_dept_head = 1;
            //         $dept_emp->created_by = Auth::user()->id;
            //         $dept_emp->save();
            //     }
            // }

            return redirect()->route('departments.all')->with('success', 'New department created');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit(Department $department)
    {
        $dept = DB::select('SELECT d.*,e.id emp_id FROM `departments` d LEFT join employee_department ed on 
            d.id=ed.department_id and ed.is_dept_head=1 left join employees e on ed.employee_id=e.id WHERE d.id='.$department->id);
        return view('departments.edit', [
            'dept' => $dept[0],
            // 'dept_head'=>EmployeeDepartment::where('department_id',$department->id)->where('is_dept_head',1)->first(),
            'emps'=>DB::select('SELECT employees.* FROM `employees` JOIN employee_department ed on employees.id=ed.employee_id WHERE ed.department_id='.$department->id)
            // 'emps'=>DB::select('SELECT employees.* FROM `employees` JOIN employee_department ed on employees.id=ed.employee_id WHERE ed.department_id='.$department->id." AND employees.user_type='E'")
            // 'emps'=>EmployeeDepartment::where('department_id',$department->id)->with('employees')->get()
        ]);
    }


    public function update(Request $request, Department $department)
    {
        // dd($request->dept_head);
        $messages = [
            'dept_name.unique' => 'This department name already exist',
        ];

        $validator = Validator::make($request->all(), [
            'dept_name' => 'required|max:90',
            // 'dept_head' => 'nullable|integer',
            'desc' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $old_dept=DB::select("select id from departments where dept_name='".$request->dept_name."' AND deleted_at IS NULL AND id NOT IN(". $department->id.")");
        if($old_dept){
            return redirect()->back()->withErrors(['dept_name'=>'The dept name has already been taken.'])->withInput();
        }
        
        try {
            $department->dept_name = $request->dept_name;
            $department->description = $request->desc;
            $department->save();
            DB::unprepared('update `employee_department` ed set `is_dept_head`=0 where ed.department_id in ('. $department->id.')');
            if($request->dept_head){
                $emp_dept=EmployeeDepartment::where('department_id',$department->id)->where('employee_id',$request->dept_head)->first();
                $emp_dept->is_dept_head=1;
                $emp_dept->save();
            }
            return redirect()->route('departments.all')->with('success', 'Record has been updated');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }


    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return redirect()->route('departments.all')->with('success', 'Record has been deleted');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }
}
