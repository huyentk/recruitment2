<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/8/2017
 * Time: 8:55 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController
{
    public function postSignIn()
    {
        return view('auth.sign-in');
    }
}