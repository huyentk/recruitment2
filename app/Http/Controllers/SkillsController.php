<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/14/2017
 * Time: 9:42 PM
 */

namespace App\Http\Controllers;
use App\Models\Skill;

class SkillsController extends Controller
{
    public function getSkillSourses(){
        return Skill::pluck('name');
    }
}