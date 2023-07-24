<?php

namespace App\Http\Controllers;

use App\Models\BackgroundVerification;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EmergencyContact;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use App\Models\EmployeeDesignation;
use App\Models\EmployeeDocument;
use App\Models\EmployeeEmploymentType;
use App\Models\EmployeeSkill;
use App\Models\EmployeeTemporaryAddress;
use App\Models\EmploymentType;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $emps = Employee::with(['departments', 'designations'])->get();
        // $emps = Employee::where('user_type','!=', 'SA')->with(['departments', 'designations'])->get();
        // return response()->json([
        //     'emps' => $emps
        // ], 200);

        return view('employees.index', [
            'emps' => $emps
        ]);
    }

    public function create()
    {
        return view('employees.add', [
            'depts' => Department::all(),
            'desig' => Designation::all(),
            'skill' => Skill::all(),
            'emp_types' => EmploymentType::all()
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'dob.required' => 'The date of birth field is required',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'gender' => 'required',
            'phone' => 'required',
            'father_name' => 'required|max:80',
            'permanent_address' => 'required',
            'dob' => 'required',
            'joining_date' => 'required',
            'marital_status' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ph_arr = explode(",", $request->phone);
        foreach ($ph_arr as $ph) {
            if (preg_match('/^[0-9]{10}+$/', $ph)) {
            } else {
                return redirect()->back()->withErrors(['phone' => 'invalid phone number'])->withInput();
            }
        }

        try {
            $old_emp = Employee::where([['fname', '=', $request->first_name], ['lname', '=', $request->last_name], ['dob', '=', $request->dob], ['father_name', '=', $request->father_name]])->first();
            if ($old_emp) {
                return redirect()->back()->withInput()->with('error', 'Employee seems already exist');
            }
            $emp = new Employee();
            $emp->employee_id = Self::generateEmpId();
            $emp->fname = $request->first_name;
            $emp->lname = $request->last_name;
            $emp->gender = $request->gender;
            $emp->phone = $request->phone;
            $emp->father_name = $request->father_name;
            $emp->permanent_address = $request->permanent_address;
            // $emp->temporary_address = $request->temporary_address;
            $emp->dob = $request->dob;
            $emp->joining_date = $request->joining_date;
            $emp->confirmation_date = $request->confirmation_date;
            $emp->marital_status = $request->marital_status;
            $emp->created_by = Auth::user()->id;
            $emp->save();

            if ($request->temporary_address) {
                EmployeeTemporaryAddress::create(['employee_id' => $emp->id, 'address' => $request->temporary_address]);
            }

            if ($request->departments) {
                $in_str = '(';
                foreach ($request->departments as $item) {
                    $arr1[] = [
                        'employee_id' => $emp->id,
                        'department_id' => $item,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $in_str .= $item . ',';
                }
                $in_str = rtrim($in_str, ',');
                $in_str .= ')';
                EmployeeDepartment::insert($arr1);
                DB::unprepared('update `departments` set total_employee=total_employee+1 where id in ' . $in_str);
            }
            if ($request->designations) {
                foreach ($request->designations as $item) {
                    $arr2[] = [
                        'employee_id' => $emp->id,
                        'designation_id' => $item,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }
                EmployeeDesignation::insert($arr2);
            }
            if ($request->skills) {
                foreach ($request->skills as $item) {
                    $arr3[] = [
                        'employee_id' => $emp->id,
                        'skill_id' => $item,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }
                EmployeeSkill::insert($arr3);
            }
            if ($request->employment_type) {
                EmployeeEmploymentType::updateOrCreate(
                    ['employee_id' => $emp->id],
                    ['employment_type_id' => $request->employment_type,]
                );
            }
            return redirect()->route('employees.all')->with('success', 'New employee created');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withInput()->with('error', 'Something unexpected happened');
        }
    }

    public function show($id, $type)
    {
        // if ($type == 'department') {
        //     $data = DB::select('SELECT dept.id,dept.dept_name FROM `departments` dept JOIN employee_department ed ON dept.id=ed.department_id AND ed.employee_id=' . $id);
        // }
        // if ($type == 'designation') {
        //     $data = DB::select('SELECT desg.id,desg.name FROM `designations` desg JOIN employee_designation ed ON desg.id=ed.designation_id AND ed.employee_id=' . $id);
        // }
        // if ($type == 'phone') {
        //     $data = Employee::where('id', $id)->first('phone');
        // }
        // $emp=Employee::find($id);
        // return response()->json($data);
        if ($type == 'employee-document') {
            $data = EmployeeDocument::find($id);
            $html = view('employees.docModalData', compact('data'))->render();
            return response()->json($html);
        }
        if ($type == 'background-verification') {
            $data = BackgroundVerification::find($id);
            $html = view('employees.backgroundModalData', compact('data'))->render();
            return response()->json($html);
        }
        if ($type == 'emergency-contact') {
            $data = EmergencyContact::find($id);
            $html = view('employees.emergencyModalData', compact('data'))->render();
            return response()->json($html);
        }
    }

    public function edit($id)
    {
        $emp = Employee::with(['departments', 'designations', 'skills', 'empType', 'emergencyContact', 'backgroundVerification', 'empDocuments', 'TemporaryAddresses'])->find($id);
        // $emp->emp_type=EmployeeEmploymentType::where('employee_id',$id)->first();
        // $emp->emp_dept = DB::select('SELECT d.* FROM `departments` d JOIN employee_department ed ON d.id=ed.department_id WHERE ed.employee_id=' . $id);
        // $emp->emergency_contact = EmergencyContact::where('employee_id', $id)->get();
        // $emp->background_verification = BackgroundVerification::where('employee_id', $id)->get();
        // $emp->emp_docs = EmployeeDocument::where('employee_id', $id)->get();

        // return response()->json([
        //     'emps' => $emp->TemporaryAddresses
        // ], 200);
        return view('employees.edit', [
            'depts' => Department::all(),
            'desig' => Designation::all(),
            'skill' => Skill::all(),
            'emp_types' => EmploymentType::all(),
            'emp' => $emp
        ]);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'dob.required' => 'The date of birth field is required',
        ];

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'father_name' => 'required|max:80',
            'marital_status' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ph_arr = explode(",", $request->phone);
        foreach ($ph_arr as $ph) {
            if (preg_match('/^[0-9]{10}+$/', $ph)) {
            } else {
                return redirect()->back()->withErrors(['phone' => 'invalid phone number'])->withInput();
            }
        }

        try {
            $emp = Employee::find($id);
            $emp->phone = $request->phone;
            $emp->father_name = $request->father_name;
            $emp->dob = $request->dob;
            $emp->joining_date = $request->joining_date;
            $emp->confirmation_date = $request->confirmation_date;
            $emp->marital_status = $request->marital_status;
            $emp->save();

            if ($request->temporary_address) {
                EmployeeTemporaryAddress::create(['employee_id' => $id, 'address' => $request->temporary_address]);
            }

            if ($request->departments) {
                $in_str = '(';
                foreach ($request->departments as $item) {
                    $arr1[] = [
                        'employee_id' => $emp->id,
                        'department_id' => $item,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $in_str .= $item . ',';
                }
                $in_str = rtrim($in_str, ',');
                $in_str .= ')';
                DB::unprepared('update `departments` set total_employee=total_employee-1 where id in (SELECT ed.department_id from employee_department ed WHERE ed.employee_id=' . $id . ')');
                EmployeeDepartment::where('employee_id', $id)->delete();
                EmployeeDepartment::insert($arr1);
                DB::unprepared('update `departments` set total_employee=total_employee+1 where id in ' . $in_str);
            }
            if ($request->designations) {
                foreach ($request->designations as $item) {
                    $arr2[] = [
                        'employee_id' => $emp->id,
                        'designation_id' => $item,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }
                EmployeeDesignation::where('employee_id', $emp->id)->delete();
                EmployeeDesignation::insert($arr2);
            }
            if ($request->skills) {
                foreach ($request->skills as $item) {
                    $arr3[] = [
                        'employee_id' => $emp->id,
                        'skill_id' => $item,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }
                EmployeeSkill::where('employee_id', $emp->id)->delete();
                EmployeeSkill::insert($arr3);
            }
            if ($request->employment_type) {
                EmployeeEmploymentType::updateOrCreate(
                    ['employee_id' => $emp->id],
                    ['employment_type_id' => $request->employment_type,]
                );
            }
            return redirect()->route('employees.all')->with('success', 'New employee created');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withInput()->with('error', 'Something unexpected happened');
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            DB::unprepared('update `departments` set total_employee=total_employee-1 where id in (SELECT ed.department_id from employee_department ed WHERE ed.employee_id=' . $employee->id . ')');
            EmployeeDepartment::where('employee_id', $employee->id)->delete();
            EmployeeDesignation::where('employee_id', $employee->id)->delete();
            EmployeeSkill::where('employee_id', $employee->id)->delete();
            EmployeeEmploymentType::where('employee_id', $employee->id)->delete();
            return redirect()->route('employees.all')->with('success', 'Record has been deleted');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }

    public function generateEmpId()
    {
        $emp = Employee::all()->last()->employee_id;
        $id = trim($emp, "EMP");
        $sequence = ltrim($id, "0");
        $new_sequence = sprintf("%'.05d", $sequence + 1);
        return 'EMP' . $new_sequence;
    }

    public function updateEmergencyContact(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:80',
            'phone' => 'required|max:10',
            'address' => 'required',
            'relation' => 'required|max:50',
            'blood_group' => 'nullable|max:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()->with('tab','emergency-contact');
        }

        try {
            // EmergencyContact::updateOrCreate(
            //     ['employee_id' => $id],
            //     ['name' => $request->name, 'phone' => $request->phone, 'address' => $request->address, 'relation' => $request->relation, 'blood_group' => $request->blood_group,'employee_id' => $id]
            // );
            EmergencyContact::create(['name' => $request->name, 'phone' => $request->phone, 'address' => $request->address, 'relation' => $request->relation, 'blood_group' => $request->blood_group, 'employee_id' => $id]);
            return redirect()->route('employees.all')->with('success', 'Record has been updated');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withInput()->with('error', 'Something unexpected happened');
        }
    }

    public function updateBackgroundVerification(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'verification_type' => 'required|max:50',
            'verification_proof' => 'required',
            'background_verification_remarks' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()->with('tab','background-verification');
        }

        if ($image = $request->file('verification_proof')) {
            $destinationPath = 'uploads/background_verification';
            $verificationFile = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $verificationFile);
        }

        try {
            // BackgroundVerification::updateOrCreate(
            //     ['employee_id' => $id],
            //     ['type' => $request->verification_type, 'proof' => $verificationFile, 'remarks' => $request->background_verification_remarks]
            // );
            BackgroundVerification::create(
                ['type' => $request->verification_type, 'proof' => $verificationFile, 'remarks' => $request->background_verification_remarks, 'employee_id' => $id]
            );
            return redirect()->route('employees.all')->with('success', 'Record has been updated');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withInput()->with('error', 'Something unexpected happened');
        }
    }

    public function updateEmpDocuments(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'document_name' => 'required|max:50',
            'upload_document' => 'required|mimes:png,pdf,jpg,jpeg',
            'upload_document_remarks' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('tab','employee-documents');
        }

        if ($image = $request->file('upload_document')) {
            $destinationPath = 'uploads/emp_documents';
            $documentFile = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $documentFile);
        }

        try {
            // BackgroundVerification::updateOrCreate(
            //     ['employee_id' => $id],
            //     ['type' => $request->verification_type, 'proof' => $verificationFile, 'remarks' => $request->background_verification_remarks]
            // );
            EmployeeDocument::create(
                ['name' => $request->document_name, 'document' => $documentFile, 'remarks' => $request->upload_document_remarks, 'employee_id' => $id]
            );
            return redirect()->route('employees.all')->with('success', 'Record has been updated');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withInput()->with('error', 'Something unexpected happened');
        }
    }
}
