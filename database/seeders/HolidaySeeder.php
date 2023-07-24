<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Holiday::insert([
            ['festival_id'=>1,'date'=>'2023-07-15'],
            ['festival_id'=>2,'date'=>'2023-01-26'],
            ['festival_id'=>3,'date'=>'2023-03-10'],
            ['festival_id'=>4,'date'=>'2023-04-06'],
            ['festival_id'=>5,'date'=>'2023-01-15'],
        ]);
    }
}
