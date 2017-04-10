<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/26/2017
 * Time: 2:53 PM
 */

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Json;

class CompanyController extends Controller
{
    public function getCompanyPage($id){
        $company = Company::find($id);
        $company->banner = Storage::url('/companies/banners/'.$id.'.png');
        if(!$company->banner)
            $company->banner = Storage::url('/companies/banners/default.png');

        $company->image = Storage::url('/companies/'.$id.'.png');
        if(!$company->banner)
            $company->banner = Storage::url('/companies/default.png');

        $jobs_all = [];
        $emp_ids = CompanyProfile::where('company_id',$company->id)->get();
        foreach ($emp_ids as $emp_id){
            $jobs = Job::where('created_by',$emp_id->id)->orderBy('created_at','desc')->get();
            foreach ($jobs as $job) {
                $emp_id = $job->created_by;
                $company_id = CompanyProfile::where('id',$emp_id)->value('company_id');
                $job->image = Storage::url('/companies/'.$company_id.'.png');
                if(!$job->image){
                    $job->image = Storage::url('/companies/default.png');
                }
                array_push($jobs_all, $job);
            }
        }

        return view('company.company_page',[
            'company' => $company,
            'jobs' => $jobs_all
        ]);
    }

    public function getJobManagement(){
        if(Auth::guest() || Auth::user()->role_id != 2){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }

        $id = Auth::user()->id;
        $company_id = CompanyProfile::where('id',$id)->pluck('company_id');
        $company = Company::find($company_id);
        $company->image = Storage::url('companies/'.$company->id.'.png');
        if(!$company->image)
            $company->image = Storage::url('companies/default.png');

        $jobs_all = [];
        $emp_ids = CompanyProfile::where('company_id',$company_id)->get();
        foreach ($emp_ids as $emp_id){
            $jobs = Job::where('created_by',$emp_id->id)->orderBy('created_at','desc')->get();
            foreach ($jobs as $job) {
                $emp_id = $job->created_by;
                $company_id = CompanyProfile::where('id',$emp_id)->value('company_id');
                $job->image = Storage::url('/companies/'.$company_id.'.png');
                if(!$job->image){
                    $job->image = Storage::url('/companies/default.png');
                }
                array_push($jobs_all, $job);
            }
        }

        return view('company.job_management')->with([
            'company' => $company,
            'jobs_all' => $jobs_all
        ]);
    }

    public function employee_getCompanyPage($emp_id){
        $company_id = CompanyProfile::find($emp_id)->value('company_id');
        $company = Company::find($company_id)->first();
        $company->banner = Storage::url('/companies/banners/'.$company->id.'.png');
        if(!$company->banner)
            $company->banner = Storage::url('/companies/banners/default.png');

        $company->image = Storage::url('/companies/'.$company->id.'.png');
        if(!$company->banner)
            $company->banner = Storage::url('/companies/default.png');

        $jobs_all = [];
        $emp_ids = CompanyProfile::where('company_id',$company->id)->get();
        foreach ($emp_ids as $emp_id){
            $jobs = Job::where('created_by',$emp_id->id)->orderBy('created_at','desc')->get();
            foreach ($jobs as $job) {
                $emp_id = $job->created_by;
                $company_id = CompanyProfile::where('id',$emp_id)->value('company_id');
                $job->image = Storage::url('/companies/'.$company_id.'.png');
                if(!$job->image){
                    $job->image = Storage::url('/companies/default.png');
                }
                array_push($jobs_all, $job);
            }
        }

        return view('company.company_page',[
            'company' => $company,
            'jobs' => $jobs_all
        ]);
    }

    public function getCreateCompanyAccount(){
        if(Auth::guest() || Auth::user()->role_id != 1){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }
        return view('company/create_account');
    }

    public function postCreateCompanyAccount(Request $request){
        if(Auth::guest() || Auth::user()->role_id != 1){
            $message = ['message_danger'=>'You do not have permission!'];
            return redirect()->route('home')->with($message);
        }
        Log::info('0');
        $this->validate( $request,[
            'email' => 'required|email|unique:users',
            'fullname' => 'required|max:120',
            'password' => 'required|min:4',
            'password-confirm' => 'required|min:4'
        ]);
        Log::info('ab');
        $email = $request['email'];
        $fullname = $request['fullname'];
        $password = $request['password'];
        $password_confirm = $request['password-confirm'];
        if($password != $password_confirm){
            $message_warning = ['message_warning' => 'Password did not match'];
            return redirect()->back()->with($message_warning);
        }
        //create User
        $user = new User();
        $user->full_name = $fullname;
        Log::info('1');
        $user->email = $email;
        Log::info('2');
        $user->password = bcrypt($password);
        Log::info('3');
        $user->role_id = 1;
        Log::info('4');
        $user->save();
        Log::info($user);
//        $employee = new CompanyProfile();
//        if(!$request['department'])
//            $request['department'] = "";
//        $employee->id = User::max('id');
//        $employee->department = $request['department'];
//        $employee->company_id = $request['company'];
//        $employee->save();
        $message_success = ['message_success' => 'Create employee\'s account successfully!'];
        return redirect()->back()->with($message_success);
    }
}