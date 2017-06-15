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
use App\Models\StudentJoinedJob;
use App\Models\User;
use App\Models\StudentApplyJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function getCompanyPage($id){
        $company = Company::find($id);
        if(Storage::exists('public/companies/banners/'.$id.'.png'))
            $company->banner = Storage::url('/companies/banners/'.$id.'.png');
        else
            $company->banner = Storage::url('/companies/banners/default.png');

        if(Storage::exists('public/companies/'.$id.'.png'))
            $company->image = Storage::url('/companies/'.$id.'.png');
        else
            $company->image = Storage::url('/companies/default.png');

        $jobs_all = [];
        $emp_ids = CompanyProfile::where('company_id',$company->id)->get();
        foreach ($emp_ids as $emp_id){
            $jobs = Job::where('created_by',$emp_id->id)->orderBy('created_at','desc')->get();
            foreach ($jobs as $job) {
                $emp_id = $job->created_by;
                $company_id = CompanyProfile::where('id',$emp_id)->value('company_id');
//                $job->image = Storage::url('/companies/'.$company_id.'.png');
//                if(!$job->image){
//                    $job->image = Storage::url('/companies/default.png');
//                }
                if(Storage::exists('public/companies/'.$company_id.'.png'))
                    $job->image = Storage::url('/companies/'.$company_id.'.png');
                else
                    $job->image = Storage::url('/companies/default.png');
                array_push($jobs_all, $job);
            }
        }

        return view('company.company_page',[
            'company' => $company,
            'jobs' => $jobs_all
        ]);
    }

    public function getJobManagement(){
        $id = Auth::user()->id;
        $company_profile = CompanyProfile::where('id',$id)->first();
        $company = Company::find($company_profile->company_id);

        if(Storage::exists('public/companies/'.$id.'.png'))
            $company->image = Storage::url('/companies/'.$company->id.'.png');
        else
            $company->image = Storage::url('/companies/default.png');

        $jobs_all = [];
        $emp_ids = CompanyProfile::where('company_id',$company->id)->get();
        foreach ($emp_ids as $emp_id){
            $jobs = Job::where('created_by',$emp_id->id)->orderBy('created_at','desc')->get();
            foreach ($jobs as $job) {
                $emp_id = $job->created_by;
                if(Storage::exists('public/companies/'.$company->id.'.png'))
                    $job->image = Storage::url('/companies/'.$company->id.'.png');
                else
                    $job->image = Storage::url('/companies/default.png');
                array_push($jobs_all, $job);
            }
        }

        return view('company.job_management')->with([
            'company' => $company,
            'jobs_all' => $jobs_all
        ]);
    }

    public function employee_getCompanyPage($emp_id){
        $company_id = CompanyProfile::where('id',$emp_id)->value('company_id');
        $company = Company::find($company_id);
        if(Storage::exists('public/companies/banners/'.$company->id.'.png'))
            $company->banner = Storage::url('/companies/banners/'.$company->id.'.png');
        else
            $company->banner = Storage::url('/companies/banners/default.png');

        if(Storage::exists('public/companies/'.$company->id.'.png'))
            $company->image = Storage::url('/companies/'.$company->id.'.png');
        else
            $company->image = Storage::url('/companies/default.png');

        $jobs_all = [];
        $emp_ids = CompanyProfile::where('company_id',$company->id)->get();
        foreach ($emp_ids as $emp_id){
            $jobs = Job::where('created_by',$emp_id->id)->orderBy('created_at','desc')->get();
            foreach ($jobs as $job) {
                $emp_id = $job->created_by;
                $company_id = CompanyProfile::where('id',$emp_id)->value('company_id');
                if(Storage::exists('public/companies/'.$company_id.'.png'))
                    $job->image = Storage::url('/companies/'.$company_id.'.png');
                else
                    $job->image = Storage::url('/companies/default.png');
                array_push($jobs_all, $job);
            }
        }

        return view('company.company_page',[
            'company' => $company,
            'jobs' => $jobs_all
        ]);
    }

    public function postCreateCompanyAccount(Request $request){
        $this->validate( $request,[
            'email' => 'required|email|unique:users',
            'fullname' => 'required|max:120',
            'password' => 'required|min:4',
            'password-confirm' => 'required|min:4'
        ]);
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
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->role_id = 2;
        $user->save();

        $employee = new CompanyProfile();
        if(!$request['department'])
            $request['department'] = "";
        $employee->id = $user->id;
        $employee->department = $request['department'];
        $employee->company_id = $request['company'];
        $employee->save();
        $message_success = ['message_success' => 'Create employee\'s account successfully!'];
        return redirect()->back()->with($message_success);
    }

    public function postAcceptJoin(Request $request){
        $id = $request['id'];
        $job_id = $request['job_id'];
        $accept = $request['accept'];
        if($accept){
            $application = StudentApplyJob::find($id);
            $application->result = 12;
            $application->save();

            $stu_id = $application->stu_id;

            $join = new StudentJoinedJob();
            $join->stu_id = $stu_id;
            $join->job_id = $job_id;
            $join->save();
            return 1000;
        }
        return -1000;
    }

    public function postEndJoin(Request $request){
        $id = $request['id'];
        $job_id = $request['job_id'];

        $application = StudentApplyJob::find($id);
        $application->result = 13;
        $application->save();

        $stu_id = $application->stu_id;

        $join = StudentJoinedJob::where('stu_id', $stu_id)->where('job_id', $job_id)->first();
        $join->end_date = Carbon::now();
        $join->save();

        return 1000;

    }

    public function postRejectJoin(Request $request){
        $id = $request['id'];
        $accept = $request['accept'];
        if($accept == 'false'){
            $application = StudentApplyJob::where('id', $id)->first();
            $application->result = 11;
            $application->save();
            return 1000;
        }
        return -1000;
    }

    public function getEditCompany($id){
        if(CompanyProfile::find(Auth::user()->id)->company_id != $id){
            $message = ['message_danger' => 'You must in this company to edit this page'];
            redirect()->back()->with($message);
        }
        $company_old = Company::find($id);
        return view('company.edit_company_page',['company_old' => $company_old]);
    }

    public function postUpdateCompany(Request $request){
        if($request->hasFile('company_banner')){
            $company_banner = $request->file('company_banner');
            Storage::put('/public/companies/banners/' .$request['company_id'].'.png', file_get_contents($company_banner->getRealPath()));
        }
        if($request->hasFile('company_logo')){
            $company_logo = $request->file('company_logo');
            Storage::put('/public/companies/' .$request['company_id'].'.png', file_get_contents($company_logo->getRealPath()));
        }
        $company = Company::find($request['company_id']);
        $company->address = $request['address'];
        $company->num_employee = $request['num_employee'];
        $company->slogan = $request['slogan'];
        $company->description = $request['description'];
        $company->save();
        return redirect()->route('get-company-page',['id' => $company->id]);
    }

    public function postCreateCompany(Request $request){
        $company = new Company();
        $company->name = $request['name'];
        $company->slogan = $request['slogan'];
        $company->description = $request['description'];
        $company->address = $request['address'];
        $company->url = $request['url'];
        $company->num_employee = $request['num_employee'];
        $company->save();

        return redirect()->route('get-company-page',['id' => $company->id]);
    }

    public function getCompanyList(){
        $companies = Company::paginate(5);
        foreach ($companies as $company){
            if(Storage::exists('public/companies/'.$company->id.'.png'))
                $company->image = Storage::url('/companies/'.$company->id.'.png');
            else
                $company->image = Storage::url('/companies/default.png');
        }
        return view('company.list_company')->with([
            'companies'=> $companies
        ]);
    }

    public function getDeleteCompany($id){
        Log::info('d');
        $employee = CompanyProfile::where('company_id',$id)->first();
        if($employee){
            $message = ['message_danger' => 'Can not delete company because this company has employee.'];
        }else{
            $company = Company::find($id)->delete();
            $message = ['message_success' => 'Delete company successfully!'];
        }
        return redirect()->route('get-company-list')->with($message);
    }
}