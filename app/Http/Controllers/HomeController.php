<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/11/2017
 * Time: 3:17 PM
 */

namespace App\Http\Controllers;
use App\Models\Articles;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\Job;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function getHomepage(){
        $jobs = Job::orderBy('created_at','desc')->limit(8)->get();
        foreach ($jobs as $job) {
            $emp_id = $job->created_by;
            $company_id = CompanyProfile::where('id',$emp_id)->value('company_id');
            $job->image = Storage::url('/companies/'.$company_id.'.png');
            if(!$job->image){
                $job->image = Storage::url('/companies/default.png');
            }
        }

        $articles = Articles::orderBy('created_at','desc')->limit(2)->get();
        foreach ($articles as $article) {
            $article->image = Storage::url('/articles/'.$article->id.'.png');
            if(!$article->image){
                $article->image = Storage::url('/articles/default.png');
            }
        }

        $companies = Company::all();
        foreach ($companies as $company) {
            $company->image = Storage::url('/companies/'.$company->id.'.png');
            if(!$company->image){
                $company->image = Storage::url('/companies/default.png');
            }
        }
        return view('homepage')->with([
            'jobs' => $jobs,
            'articles' => $articles,
            'companies' => $companies
        ]);
    }

    public function getContactUs(){
        return view('contact');
    }
}