<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::insert([
            ['name'=>'dept_1','head'=>'dept_head_1'],
            ['name'=>'dept_2','head'=>'dept_head_2'],
        ]);
    }
}
