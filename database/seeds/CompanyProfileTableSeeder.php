<?php

use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;
class CompanyProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyProfile::create([
            'id' => 2,
            'department' => 'Human-resources',
            'company_id' => 1,
            'is_super' => 1
        ]);
        CompanyProfile::create([
            'id' => 3,
            'department' => 'Human-resources',
            'company_id' => 1,
        ]);
        CompanyProfile::create([
            'id' => 4,
            'department' => 'Human-resources',
            'company_id' => 2,
            'is_super' => 1
        ]);
    }
}
