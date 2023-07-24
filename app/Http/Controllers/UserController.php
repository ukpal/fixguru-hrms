<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmploymentType;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeDesignation;
use App\Models\EmployeeEmploymentType;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeSkill;
use App\Models\ModuleAccess;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Employee::find(Auth::user()->id);
        if (!$user->hasPermissionTo('view users')) {
            return redirect('dashboard')->with('error', 'You are not permitted with that!');
        }
        return view('users.index', [
            'emps' => Employee::where('user_type', '!=', 'E')->get()
        ]);
    }

    public function create()
    {
        return view('users.add', [
            'emps' => Employee::where('user_type', 'E')->get()
        ]);
    }

    public function store(Request $request)
    {
        // $messages = [
        //     'dob.required' => 'The date of birth field is required',
        // ];

        $validator = Validator::make($request->all(), [
            'employee' => 'required',
            'role' => 'required',
            'username' => 'required|max:45',
            'password' => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $emp = Employee::find($request->employee);
            $emp->username = $request->username;
            $emp->password = Hash::make($request->password);
            $emp->user_type = $request->role;
            $emp->save();

            if ($request->role == 'SA') {
                $modules = DB::table('modules')->pluck('id');
                foreach ($modules as $value) {
                    $arr[] = ['employee_id' => $emp->id, 'module_id' => $value, 'view' => 1, 'edit' => 1, 'created_at' => date('Y-m-d H:i:s')];
                }
                DB::table('module_access')->insert($arr);
            }

            return redirect()->route('users.all')->with('success', 'New user created');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }

    public function destroy(Request $request, Employee $employee)
    {
        try {
            $employee->username = NULL;
            $employee->password = NULL;
            $employee->user_type = 'E';
            $employee->save();
            return redirect()->route('users.all')->with('success', 'User successfully removed');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }

    public function getAccess($id)
    {
        // return $id;
        // $modules = DB::table('modules')->select('modules.module','modules.id as m_id', 'module_access.*')
        //     ->leftJoin(
        //         'module_access',
        //         'modules.id',
        //         '=',
        //         DB::raw('module_access.module_id AND module_access.employee_id = ' . $id)
        //     )->orderBy('modules.id')->get();
        // return view('users.userAccess',compact('modules'));
        return view('users.userAccess');
    }

    public function setAccess(Request $request)
    {
        $user = Employee::find($request->user_id);
        if ($request->checkbox_val) {
            $user->givePermissionTo($request->check_name);
        } else {
            $user->revokePermissionTo($request->check_name);
        }
        // $data = DB::table('module_access')->where([['employee_id', '=', $user_id], ['module_id', '=', $module_id]])->first();
        // if (!$data) {
        //     DB::table('module_access')->insert([
        //         'employee_id' => $user_id,
        //         'module_id' => $module_id,
        //         $check_name => $checkbox_val
        //     ]);
        // } else {
        //     DB::table('module_access')->where('id', $data->id)->update([
        //         $check_name => $checkbox_val
        //     ]);
        // }
    }
}
