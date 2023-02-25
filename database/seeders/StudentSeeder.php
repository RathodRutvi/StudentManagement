<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::updateorCreate([
            'id'=>'1',
            'name'=>'riya',

        ]);
        Student::updateorCreate([
            'id'=>'2',
            'name'=>'monali',

        ]);
        Student::updateorCreate([
            'id'=>'3',
            'name'=>'pooja',

        ]);
    }
}
