<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeeDepartment extends Model
{
    use HasFactory;
    protected $table='employee_department';
    protected $guarded=[];

    // public function employees(){
    //     return $this->belongsTo(Employee::class);
    // }
}
