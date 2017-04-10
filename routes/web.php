<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[
    'uses' => 'HomeController@getHomepage'
])->name('home');

Route::get('/signin',function () {
    return view('auth.sign-in');
})->name('get-sign-in');

Route::get('/signup',function () {
    return view('auth.sign-up');
})->name('get-sign-up');

Route::post('/sign-in',[
    'uses' => 'UserController@postSignIn',
    'as' => 'sign-in'
]);

Route::get('/logout',[
    'uses' => 'UserController@getLogout',
    'as' => 'log-out'
]);

Route::post('/sign-up',[
    'uses' => 'UserController@postSignUp',
    'as' => 'sign-up'
]);
//facebook login
Route::get('auth/facebook',[
    'uses' => 'Auth\LoginController@redirectToProvider',
    'as' => 'auth-facebook'
]);
Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallback');

/*-------------------Job--------------------*/
Route::get('/{id}/job-detail',[
    'uses' => 'JobsController@getJobDetail',
    'as' => 'job_detail'
]);

//get for job in header (for search)
Route::get('jobs-list',[
    'uses' => 'JobsController@getJobsList',
    'as' => 'get-jobs-list'
]);

Route::post('jobs-list',[
    'uses' => 'JobsController@postJobsList',
    'as' => 'post-jobs-list'
]);

Route::get('jobs',[
    'uses' => 'SkillsController@getSkillSourses',
    'as' => 'getJobSources'
]);

Route::get('{id}/register-page',[
    'uses' => 'JobsController@getRegisterJob',
    'as' => 'get-register-page'
]);

Route::post('apply-job',[
   'uses' => 'StudentController@postRegisterJob',
    'as' => 'post-register-job'
]);

Route::post('save-file',[
    'uses' => 'StudentController@postSaveFile',
    'as' => 'post-save-file'
]);

Route::get('create-job',[
    'uses' => 'JobsController@getCreateJob',
    'as' => 'get-create-job'
]);

Route::post('create-job',[
    'uses' => 'JobsController@postCreateJob',
    'as' => 'post-create-job'
]);

Route::post('post-update-job',[
   'uses' => 'JobsController@postUpdateJob',
    'as' => 'post-update-job'
]);

/*------------------Student--------------------*/
Route::get('{id}/student-page',[
   'uses' => 'StudentController@getStudentPage',
    'as' => 'get-student-page'
]);

//update account infomation has pas
Route::post('update-account-info-has-pass',[
    'uses' => 'StudentController@postUpdateAccountInfoHasPass',
    'as' => 'update-account-info-has-pass'
]);

//update account infomation no pas
Route::post('update-account-info-no-pass',[
    'uses' => 'StudentController@postUpdateAccountInfoNoPass',
    'as' => 'update-account-info-no-pass'
]);

//update persional details
Route::post('update-persional-detail',[
    'uses' => 'StudentController@postUpdatePersionalDetails',
    'as' => 'update-persional-detail'
]);

//change ava
Route::post('update-ava',[
    'uses' => 'StudentController@postUpdateAva',
    'as' => 'update-ava'
]);

//Contact Us
Route::get('contact-us',[
    'uses' => 'HomeController@getContactUs',
    'as' => 'get-contact'
]);

//Articles List
Route::get('articles',[
    'uses' => 'ArticlesController@getArticlesList',
    'as' => 'articles-list'
]);

//Articles Detail
Route::get('/{id}/article-detail',[
    'uses' => 'ArticlesController@getArticleDetail',
    'as' => 'article-detail'
]);

//Post article
Route::get('post-article',function(){
    return view('articles.post_article');
});

Route::post('submit-article',[
    'uses' => 'ArticleController@postArticle',
    'as' => 'submit-article'
]);
]);

/*-----------------Company------------------*/
Route::get('{id}/employee-page',[
    'uses' => 'EmployeeController@getEmployeePage',
    'as' => 'get-employee-page'
]);

Route::post('update-persional-detail-emp',[
   'uses' => 'EmployeeController@postUpdatePersionalDetails',
    'as' => 'update-persional-detail-emp'
]);

Route::get('{id}/company-page',[
   'uses' => 'CompanyController@getCompanyPage',
    'as' => 'get-company-page'
]);

Route::get('emp/{emp_id}/company-page',[
    'uses' => 'CompanyController@employee_getCompanyPage',
    'as' => 'employee-get-company-page'
]);

Route::get('/job_management',[
    'uses' => 'CompanyController@getJobManagement',
    'as' => 'get-job-management'
]);

Route::get('/create_account_company',[
    'uses' => 'CompanyController@getCreateCompanyAccount',
    'as' => 'create-company-account'
]);

Route::post('/create_account_company',[
    'uses' => 'CompanyController@postCreateCompanyAccount',
    'as' => 'create-company-account'
]);