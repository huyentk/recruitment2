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
}