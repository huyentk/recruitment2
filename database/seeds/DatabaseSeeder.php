<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(StudentProfileTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(CompanyProfileTableSeeder::class);
        $this->call(JobTableSeeder::class);
        $this->call(StudentApplyJobTableSeeder::class);
        $this->call(StudentJoinedJobTableSeeder::class);
        $this->call(SkillTableSeeder::class);
        $this->call(JobSkillTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(ContactTableSeeder::class);
    }
}
