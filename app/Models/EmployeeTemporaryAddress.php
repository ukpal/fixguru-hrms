<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTemporaryAddress extends Model
{
    use HasFactory;
    protected $table='employee_temporary_addresses';
    protected $guarded=[];
}
