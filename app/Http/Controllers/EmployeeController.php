<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/24/2017
 * Time: 11:58 PM
 */

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function getEmployeePage($id){
        $emp_info = User::find($id);
        $emp_info->department = CompanyProfile::select('department')->where('id',$id)->first();
        $emp_info->company = CompanyProfile::find($id)->company;
//        $emp_info->image = file_exists(public_path().'/storage/avatars/'.Auth::user()->id.'.png') ? Storage::url('/avatars/'.Auth::user()->id.'.png') : Storage::url('/avatars/user.png');
        if(Storage::exists('public/avatars/'.$id.'.png'))
            $emp_info->image = Storage::url('/avatars/'.$id.'.png');
        else
            $emp_info->image = Storage::url('/avatars/user.png');
        return view('company.employee_page')->with([
            'emp_info' => $emp_info
        ]);
    }

    public function postUpdatePersonalDetails(Request $request){
        $user = User::find(Auth::user()->id);
        $user->gender = $request['gender'];
        $user->address = $request['address'] != null ? $request['address'] : '';
        $user->skype_id = $request['skype_id'] != null ? $request['skype_id'] : '';
        $user->phone = $request['phone'] != null ? $request['phone'] : '';
        $user->save();

        $conmpany_profile = CompanyProfile::find(Auth::user()->id);
        $conmpany_profile->department = $request['department'] != null ? $request['department'] : '';
        $conmpany_profile->save();

        $user->department = $conmpany_profile->department;

        return $user;
    }

    public function getCreateEmployee(){
        $companies = Company::all();
        return view('company/create_account')->with(['companies' => $companies]);
    }
}