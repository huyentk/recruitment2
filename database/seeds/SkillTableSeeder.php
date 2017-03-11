<?php

use Illuminate\Database\Seeder;
use App\Models\Skill;
class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::create([
            'name' => 'PHP'
        ]);
        Skill::create([
            'name' => 'HTML/CSS'
        ]);
        Skill::create([
            'name' => 'SQL'
        ]);
        Skill::create([
            'name' => 'Java'
        ]);
        Skill::create([
            'name' => 'R'
        ]);
        Skill::create([
            'name' => 'Python'
        ]);
    }
}
