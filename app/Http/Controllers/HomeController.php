<?php
/**
 * Created by PhpStorm.
 * User: HuyenTran
 * Date: 3/11/2017
 * Time: 3:17 PM
 */

namespace App\Http\Controllers;
use App\Models\Articles;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class HomeController
{
    public function getHomepage(){
        $jobs = Job::all();
        foreach ($jobs as $job) {
            $job->image = Storage::url('/job_images/'.$job->id.'.png');
            if(!$job->image){
                $job->image = Storage::url('/job_images/default.png');
            }
        }

        $articles = Articles::all();
        foreach ($articles as $article) {
            $article->image = Storage::url('/articles/'.$article->id.'.png');
            if(!$article->image){
                $article->image = Storage::url('/articles/default.png');
            }
        }

        return view('homepage')->with([
            'jobs' => $jobs,
            'articles' => $articles
        ]);
    }
}