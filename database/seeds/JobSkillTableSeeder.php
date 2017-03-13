<?php

use Illuminate\Database\Seeder;
use App\Models\JobSkill;
class JobSkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        JobSkill::create([
            'job_id' => 1,
            'skill_id' => 1,
            'skill_name' => 'PHP'
        ]);
        JobSkill::create([
            'job_id' => 1,
            'skill_id' => 2,
            'skill_name' => 'HTML/CSS'
        ]);
        JobSkill::create([
            'job_id' => 1,
            'skill_id' => 3,
            'skill_name' => 'SQL'
        ]);
        //2
        JobSkill::create([
            'job_id' => 2,
            'skill_id' => 1,
            'skill_name' => 'PHP'
        ]);
        JobSkill::create([
            'job_id' => 2,
            'skill_id' => 2,
            'skill_name' => 'HTML/CSS'
        ]);
        JobSkill::create([
            'job_id' => 2,
            'skill_id' => 3,
            'skill_name' => 'SQL'
        ]);
        //3
        JobSkill::create([
            'job_id' => 3,
            'skill_id' => 1,
            'skill_name' => 'PHP'
        ]);
        JobSkill::create([
            'job_id' => 3,
            'skill_id' => 4,
            'skill_name' => 'Java'
        ]);
        JobSkill::create([
            'job_id' => 3,
            'skill_id' => 5,
            'skill_name' => 'R'
        ]);
        //4
        JobSkill::create([
            'job_id' => 4,
            'skill_id' => 1,
            'skill_name' => 'PHP'
        ]);
        JobSkill::create([
            'job_id' => 4,
            'skill_id' => 4,
            'skill_name' => 'Java'
        ]);
        JobSkill::create([
            'job_id' => 4,
            'skill_id' => 6,
            'skill_name' => 'Python'
        ]);
        //5
        JobSkill::create([
            'job_id' => 5,
            'skill_id' => 2,
            'skill_name' => 'HTML/CSS'
        ]);
        JobSkill::create([
            'job_id' => 5,
            'skill_id' => 3,
            'skill_name' => 'SQL'
        ]);
        JobSkill::create([
            'job_id' => 5,
            'skill_id' => 5,
            'skill_name' => 'R'
        ]);
        //6
        JobSkill::create([
            'job_id' => 6,
            'skill_id' => 3,
            'skill_name' => 'SQL'
        ]);
        JobSkill::create([
            'job_id' => 6,
            'skill_id' => 4,
            'skill_name' => 'Java'
        ]);
        JobSkill::create([
            'job_id' => 6,
            'skill_id' => 6,
            'skill_name' => 'Python'
        ]);
        //7
        JobSkill::create([
            'job_id' => 7,
            'skill_id' => 3,
            'skill_name' => 'SQL'
        ]);
        JobSkill::create([
            'job_id' => 7,
            'skill_id' => 4,
            'skill_name' => 'Java'
        ]);
        JobSkill::create([
            'job_id' => 7,
            'skill_id' => 5,
            'skill_name' => 'R'
        ]);
        //8
        JobSkill::create([
            'job_id' => 8,
            'skill_id' => 1,
            'skill_name' => 'PHP'
        ]);
        JobSkill::create([
            'job_id' => 8,
            'skill_id' => 6,
            'skill_name' => 'Python'
        ]);
        JobSkill::create([
            'job_id' => 8,
            'skill_id' => 2,
            'skill_name' => 'HTML/CSS'
        ]);
    }
}
