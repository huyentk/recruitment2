@extends('layouts.master')

@section('title')
    Create Job
@endsection
@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/job_detail.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/homepage.css') }}">
    <script src="{{ URL::to('js/create_job.js') }}"></script>
@endsection
@section('content')
    <div class="front"></div>
    <div class="row" style="height: 665px;">
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
                </div>
            </div>
        </div>
        <div class="col-md-8" style="padding-right: 50px;">
            <div class="row">
                @foreach($jobs_all as $job)
                    <div class="col-md-6 job_content_management_page">
                        <a href="{{ route('job_detail',['id' => $job->id]) }}">
                            <div>
                                <h4 style="font-weight: bold">{{ $job->name }}</h4>
                                <h4>{{ $job->salary }} / month</h4>
                                <h4>{{ $job->num_register }} registered</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        var urlListJob = '{{ route('get-jobs-list') }}';
        var urlCreateJob = '{{ route('post-create-job') }}';
        var _token = '{{ Session::token() }}';
    </script>
@endsection