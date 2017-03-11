<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
           'name' => 'administrator'
        ]);
        Role::create([
            'name' => 'company'
        ]);
        Role::create([
            'name' => 'student'
        ]);
    }
}
