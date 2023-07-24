<?php

namespace Database\Seeders;

use App\Models\Festival;
use Illuminate\Database\Seeder;

class FestivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Festival::insert([
            ['name'=>'Independent Day'],
            ['name'=>'Republic Day'],
            ['name'=>'Holi'],
            ['name'=>'Mahavir Jayanti'],
            ['name'=>'Makara Sankranti'],
        ]);
    }
}
