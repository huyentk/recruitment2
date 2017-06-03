@extends('layouts.master')

@section('title')
    Company Page
@endsection

@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/company_page.css') }}">
    {{--<script type="application/javascript" src="{{ URL::to('/js/update_emp_info.js') }}"></script>--}}
@endsection

@section('content')
    <div style="margin-bottom: -30px;max-height: 100%;overflow: hidden;">
        <img src="{{ $company->banner }}" class="img-responsive">
    </div>
    <div style="height: 100%;display: flex; padding-top: 30px;padding-bottom:20px;background-color: transparent; z-index: 3;border: 1px solid #ded7d7">
        <div class="logo-container">
            <div class="left-position-logo logo">
                <img src="{{ $company->image }}" alt="logo" style="padding-left: 20px;">
            </div>
        </div>
        <div class="name-and-info">
            <h1 class="title">
                {{ $company->name }}
            </h1>
            <div class="company-info">
                <span style="font-size: 20px;"><i class="fa fa-map-marker"> {{ $company->address }}</i></span><br>
                <span style="font-size: 20px;"><i class="fa fa-users"> {{ $company->num_employee }}+ Employee</i></span>
            </div>
        </div>
    </div>
    <div style="padding: 25px;">
        <h2>Overview</h2>
        <hr style="margin: 0;"/>
        <div>
            <h3 style="font-weight: bold;">{{ $company->slogan }}</h3>
            <h4 style="line-height: 35px;text-align: justify">{!! nl2br(e($company->description)) !!}</h4>
        </div>
    </div>
    <center>
        <div style="width: 68%;">
            <h2>Our Jobs For You</h2>
            <hr style="margin-top: 0;"/>
            <div class="row">
                @foreach($jobs as $job)
                    <div class="col-md-6">
                        <h4 style="font-weight: bold"><a href="{{ route('job_detail',['id' => $job->id]) }}">{{ $job->name }}</a></h4>
                        <h4>{{ $job->salary }} / month</h4>
                        <h4>{{ $job->num_register }} registered</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </center>
@endsection