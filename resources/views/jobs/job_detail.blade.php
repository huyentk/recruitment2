@extends('layouts.master')

@section('title')
    Job Detail
@endsection
@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/job_detail.css') }}"/>
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
                    <h4 style="color: red"><a href="#">About Us ></a></h4>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="job_detail">
                <h2 style="margin-bottom: 20px;">{{ $job->name }}</h2>
                <div class="row">
                    @foreach($job_skills as $job_skill)
                        <div class="col-md-3">
                            <p style="font-size: 18px;"><i class="fa fa-tag fa-lg" style="color: #9a5406;" aria-hidden="true"></i>&nbsp; {{ $job_skill->skill_name->name }}</p>
                        </div>
                    @endforeach
                </div>
                <p style="font-size: 18px;"><i class="fa fa-money fa-lg" style="color: #9a5406;" aria-hidden="true"></i>&nbsp; {{ $job->salary }} /month</p>
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
                @endif
                <hr/>
                <h3>Job Description</h3>
                <p class="paragraph">
                    {!!  nl2br(e($job->description)) !!}
                </p>
                <br/>
                <h3>Requirements</h3>
                <p class="paragraph">
                    {!!  nl2br(e($job->requirements)) !!}
                </p>
                <br/>
                <h3>Benefits</h3>
                <p class="paragraph">
                    {!!  nl2br(e($job->benefits)) !!}
                </p>
                <br/>
            </div>
        </div>
    </div>

@endsection