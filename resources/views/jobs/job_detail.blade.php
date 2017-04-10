@extends('layouts.master')

@section('title')
    Job Detail
@endsection
@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/job_detail.css') }}"/>
    <script src="{{ URL::to('js/edit_job.js') }}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="company-info">
                    <img class="img-rounded" src="{{ $company->image }}">
                    <br/>
                    <h2 style="font-weight: bold; color: black; margin-bottom: 22px;">{{ $company->name }}</h2>
                    <h4 style="margin-bottom: 22px;">{{ $company->slogan }}</h4>
                    <p style="text-align: left;"><i class="fa fa-users fa-lg " style="color: #9a5406;" aria-hidden="true"></i>&nbsp; Quy mô công ty: {{ $company->num_employee }} +</p>
                    <p style="text-align: left;"><i class="fa fa-map-marker fa-lg" style="color: #9a5406;" aria-hidden="true"></i>&nbsp; {{ $company->address }}</p>
                    <br/>
                    <br/>
                    <h4 style="color: red"><a href="{{ route('get-company-page',['id' => $company->id]) }}">About Us ></a></h4>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="job_detail">
                <h2 style="margin-bottom: 20px;" id="job_name">{{ $job->name }}</h2>
                <div class="row" id="own_skill">
                    @foreach($job_skills as $job_skill)
                        <div class="col-md-3">
                            <p style="font-size: 18px;"><i class="fa fa-tag fa-lg" style="color: #9a5406;" aria-hidden="true"></i>&nbsp; {{ $job_skill->skill_name->name }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="row" id="append_skill">

                </div>
                <div class="row" style="display: none;padding: 15px;width:550px;" id="select_skill">
                    <label for="select_list">Select skill (select one):</label>
                    <select class="form-control" id="select_list">
                        <option value="1">PHP</option>
                        <option value="2">HTML/CSS</option>
                        <option value="3">SQL</option>
                        <option value="4">Java</option>
                        <option value="5">R</option>
                        <option value="6">Python</option>
                    </select>
                </div>
                <div class="row" style="display: flex" >
                    <i class="fa fa-money fa-lg" style="color: #9a5406;margin-top: 10px;margin-left: 16px;margin-right: 2px;" aria-hidden="true"></i>
                    <p id="job_salary" style="font-size: 18px;">{{ $job->salary }} </p> &nbsp;/month
                </div>
                @if(Auth::guest())
                    <button type="button" class="btn btn-primary btn-lg" style="width: 130px;"><a href="{{ route('get-sign-in') }}" style="text-decoration: none;color: whitesmoke">Apply</a></button>
                @elseif(Auth::user()->role_id == 3)
                    @if($result == 0)
                        <button type="button" class="btn btn-success btn-lg" style="width: 130px;"><a href="{{ route('get-register-page',['job_id'=>$job->id]) }}" style="text-decoration: none;color: whitesmoke">Apply</a></button>
                    @elseif($result == 10)
                        <button type="button" class="btn btn-success btn-lg disabled" style="width: 130px;">Wating</button>
                    @elseif($result == 11)
                        <button type="button" class="btn btn-info btn-lg disabled" style="width: 130px;">Fail</button>
                    @elseif($result == 12)
                        <button type="button" class="btn btn-danger btn-lg disabled" style="width: 130px;">Joining</button>
                    @elseif($result == 13)
                        <button type="button" class="btn btn-warning btn-lg disabled" style="width: 130px;">Finished</button>
                    @endif
                @elseif(Auth::user()->role_id == 2)
                    @if(isset($do_not_show_edit))
                    @else
                        <button type="button" class="btn btn-primary btn-lg" id="edit" style="width: 130px;">Edit</button>
                        <button type="button" class="btn btn-success btn-lg" id="save-change" style="width: 130px;display: none" >Save</button>
                    @endif
                @endif
                <hr/>
                <h3>Job Description</h3>
                <p class="paragraph" id="job_description">
                    {!!  nl2br(e($job->description)) !!}
                </p>
                <br/>
                <h3>Requirements</h3>
                <p class="paragraph" id="job_requirement">
                    {!!  nl2br(e($job->requirements)) !!}
                </p>
                <br/>
                <h3>Benefits</h3>
                <p class="paragraph" id="job_benefit">
                    {!!  nl2br(e($job->benefits)) !!}
                </p>
                <br/>
            </div>
        </div>
    </div>
    @if(isset($students_apply_job))
        <div class="row" style="margin: 25px;">
            <table class="table table-striped">
                <thead style="text-align: center">
                    <tr>
                        <th class="col-md-4">Full Name</th>
                        <th class="col-md-5">University</th>
                        <th class="col-md-3">Major</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students_apply_job as $student_apply_job)
                        <tr>
                            <td>{{ $student_apply_job->full_name }}</td>
                            <td>{{ $student_apply_job->university }}</td>
                            <td>{{ $student_apply_job->major }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <script>
        var urlJobDetail = '{{ route('job_detail',['id'=>$job->id]) }}';
        var urlUpdateJob = '{{ route('post-update-job') }}';
        var job_id = '{{ $job->id }}';
        var _token = '{{ Session::token() }}';
    </script>
@endsection