<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use HasRoles;
    protected $dates = ['deleted_at'];
    protected $guarded = [];


    public function departments()
    {
        return $this->belongsToMany(Department::class, 'employee_department', 'employee_id', 'department_id');
    }

    public function designations()
    {
        return $this->belongsToMany(Designation::class, 'employee_designation', 'employee_id', 'designation_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'employee_skill', 'employee_id', 'skill_id');
    }

    public function empType()
    {
        return $this->belongsToMany(EmploymentType::class, 'employee_employment_type', 'employee_id', 'employment_type_id');
    }

    public function emergencyContact()
    {
        return $this->hasMany(EmergencyContact::class, 'employee_id');
    }

    public function backgroundVerification()
    {
        return $this->hasMany(BackgroundVerification::class, 'employee_id');
    }

    public function empDocuments()
    {
        return $this->hasMany(EmployeeDocument::class, 'employee_id');
    }

    public function TemporaryAddresses()
    {
        return $this->hasMany(EmployeeTemporaryAddress::class, 'employee_id');
    }

}
