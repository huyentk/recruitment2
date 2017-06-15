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
use App\Models\Contact;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function getHomepage(){
        $jobs = Job::orderBy('created_at','desc')->limit(8)->get();
        foreach ($jobs as $job) {
            $emp_id = $job->created_by;
            $company_id = CompanyProfile::where('id',$emp_id)->value('company_id');
            if(Storage::exists('public/companies/'.$company_id.'.png'))
                $job->image = Storage::url('/companies/'.$company_id.'.png');
            else
                $job->image = Storage::url('/companies/default.png');
        }

        $articles = Articles::orderBy('created_at','desc')->limit(2)->get();
        foreach ($articles as $article) {
            if(Storage::exists('public/articles/'.$article->id.'.png'))
                $article->image = Storage::url('/articles/'.$article->id.'.png');
            else
                $article->image = Storage::url('/articles/default.png');
        }

        $companies = Company::limit(6)->get();
        foreach ($companies as $company) {
            if(Storage::exists('public/companies/'.$company->id.'.png'))
                $company->image = Storage::url('/companies/'.$company->id.'.png');
            else
                $company->image = Storage::url('/companies/default.png');
        }
        return view('homepage')->with([
            'jobs' => $jobs,
            'articles' => $articles,
            'companies' => $companies
        ]);
    }

    public function getContactUs(){
        $contact = Contact::find(1);
        return view('basic.contact')->with(['contact' => $contact]);
    }

    public function getUpdateContact(){
        $contact = Contact::find(1);
        Log::info($contact);
        return view('basic.update_contact')->with(['contact' => $contact]);
    }
    public function postUpdateContact(Request $request){
        $contact = Contact::find(1);
        $contact->phone = $request['phone'];
        $contact->email = $request['email'];
        $contact->location = $request['location'];
        $contact->fb = $request['fb'];
        $contact->save();

        return redirect()->route('get-contact');
    }
}