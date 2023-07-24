<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        // Permission::create(['name' => 'edit holidays']);
        // $user=Employee::find(Auth::user()->id);
        // $user->givePermissionTo('view employees');
        return view('dashboard.index', [
            'total_emp' => User::count(),
            'total_dept' => Department::count(),
            'total_holiday' => Holiday::count()
        ]);
    }
}
