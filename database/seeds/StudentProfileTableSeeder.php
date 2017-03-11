<?php

use Illuminate\Database\Seeder;
use App\Models\StudentProfile;
class StudentProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentProfile::create([
            'university' => 'University of Information Technology',
            'major' => 'Information System'
        ]);
        StudentProfile::create([
            'university' => 'Banking University of HCM',
            'major' => 'Information System'
        ]);
        StudentProfile::create([
            'university' => 'University of Information Technology',
            'major' => 'Information System'
        ]);
    }
}
