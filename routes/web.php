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
])->middleware('checkUserAlreadyLogin');

Route::get('/logout',[
    'uses' => 'UserController@getLogout',
    'as' => 'log-out'
]);

Route::post('/sign-up',[
    'uses' => 'UserController@postSignUp',
    'as' => 'sign-up'
])->middleware('checkUserAlreadyLogin');

////facebook login
//Route::get('auth/facebook',[
//    'uses' => 'Auth\LoginController@redirectToProvider',
//    'as' => 'auth-facebook'
//]);
//Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallback');

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
])->middleware('checkUserIsStudent');

Route::post('apply-job',[
   'uses' => 'StudentController@postRegisterJob',
    'as' => 'post-register-job'
])->middleware('checkUserIsStudent');

Route::post('save-file',[
    'uses' => 'StudentController@postSaveFile',
    'as' => 'post-save-file'
]);

Route::get('create-job',[
    'uses' => 'JobsController@getCreateJob',
    'as' => 'get-create-job'
])->middleware('checkUserIsEmployee');

Route::post('create-job',[
    'uses' => 'JobsController@postCreateJob',
    'as' => 'post-create-job'
])->middleware('checkUserIsEmployee');

Route::post('post-update-job',[
   'uses' => 'JobsController@postUpdateJob',
    'as' => 'post-update-job'
])->middleware('checkUserIsEmployee');

Route::post('post-delete-job',[
    'uses' => 'JobsController@postDeleteJob',
    'as' => 'delete-job'
])->middleware('checkUserIsEmployee');

/*------------------Student--------------------*/
Route::get('{id}/student-page',[
   'uses' => 'StudentController@getStudentPage',
    'as' => 'get-student-page'
])->middleware('checkUserIsStudent');

//update account infomation has pas
Route::post('update-account-info-has-pass',[
    'uses' => 'StudentController@postUpdateAccountInfoHasPass',
    'as' => 'update-account-info-has-pass'
])->middleware('checkUserIsGuest');

//update account infomation no pas
Route::post('update-account-info-no-pass',[
    'uses' => 'StudentController@postUpdateAccountInfoNoPass',
    'as' => 'update-account-info-no-pass'
])->middleware('checkUserIsGuest');

//update persional details
Route::post('update-persional-detail',[
    'uses' => 'StudentController@postUpdatePersonalDetails',
    'as' => 'update-persional-detail'
])->middleware('checkUserIsStudent');

//change ava
Route::post('update-ava',[
    'uses' => 'StudentController@postUpdateAva',
    'as' => 'update-ava'
])->middleware('checkUserIsGuest');

/*-----------------Contact Us---------------*/
Route::get('contact-us',[
    'uses' => 'HomeController@getContactUs',
    'as' => 'get-contact'
]);

/*-----------------Article------------------*/

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
Route::get('post-article', function(){
    return view('articles.post_article');
})->name('post-article');


Route::post('add-article',[
    'uses' => 'ArticleController@addArticle',
    'as' => 'add-article'
]);

// Edit article
Route::get('edit-article',[
    'uses' => 'ArticlesController@getEditArticle',
    'as' => 'edit-article'
]);

// Update article
Route::post('update-article',[
    'uses' => 'ArticleController@updateArticle',
    'as' => 'update-article'
]);

//Delete article
Route::get('/{id}/delete-article',[
    'uses' => 'ArticlesController@deleteArticle',
    'as' => 'delete-article'
]);

/*-----------------Company------------------*/
Route::get('{id}/employee-page',[
    'uses' => 'EmployeeController@getEmployeePage',
    'as' => 'get-employee-page'
])->middleware('checkUserIsEmployee');

Route::post('update-persional-detail-emp',[
   'uses' => 'EmployeeController@postUpdatePersonalDetails',
    'as' => 'update-persional-detail-emp'
])->middleware('checkUserIsEmployee');

Route::get('{id}/company-page',[
   'uses' => 'CompanyController@getCompanyPage',
    'as' => 'get-company-page'
]);

Route::get('emp/{emp_id}/company-page',[
    'uses' => 'CompanyController@employee_getCompanyPage',
    'as' => 'employee-get-company-page'
])->middleware('checkUserIsEmployee');

Route::get('/job-management',[
    'uses' => 'CompanyController@getJobManagement',
    'as' => 'get-job-management'
])->middleware('checkUserIsCompany');

Route::get('/create-account-company',function (){
    return view('company/create_account');
})->middleware('checkUserIsAdmin');

Route::post('/create-account-company',[
    'uses' => 'CompanyController@postCreateCompanyAccount',
    'as' => 'create-company-account'
])->middleware('checkUserIsCompany');

Route::get('/{id}/get-edit-company',[
    'uses' => 'CompanyController@getEditCompany',
    'as' => 'edit-company-page'
])->middleware('checkUserIsCompany');

Route::post('update-company-page',[
    'uses' => 'CompanyController@postUpdateCompany',
    'as' => 'update-company-page'
])->middleware('checkUserIsCompany');

Route::get('create-company',function (){
   return view('company.create_company');
})->middleware('checkUserIsAdmin')->name('create-company');

Route::post('create-company',[
    'uses' => 'CompanyController@postCreateCompany',
    'as' => 'post-create-company'
])->middleware('checkUserIsAdmin');

Route::get('company-list', [
    'uses' => 'CompanyController@getCompanyList',
    'as' => 'get-company-list'
]);

/*-----------------Introduce------------------*/
Route::get('introduce', function(){
    return view('introduce');
})->name('introduce');

Route::post('accept-join',[
   'uses' => 'CompanyController@postAcceptJoin',
    'as' => 'accept-join'
])->middleware('checkUserIsCompany');

Route::post('reject-join',[
    'uses' => 'CompanyController@postRejectJoin',
    'as' => 'reject-join'
])->middleware('checkUserIsCompany');
