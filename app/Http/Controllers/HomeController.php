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
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function getHomepage(){
        $jobs = Job::orderBy('created_at','desc')->limit(8)->get();
        foreach ($jobs as $job) {
            $job->image = Storage::url('/job_images/'.$job->id.'.png');
            if(!$job->image){
                $job->image = Storage::url('/job_images/default.png');
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
}