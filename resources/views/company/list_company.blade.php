@extends('layouts.master')

@section('title')
    Companies List
@endsection

@section('script_and_style')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/homepage.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-offset-1">
            <h3 style="line-height: 50px;">Company List</h3>
        </div>
    </div>
    <hr>
    <div>
        @foreach($companies as $company)
            <div class="row job_content">
                <div class="col-md-2 job_content_div">
                    <img src="{{ $company->image }}" class="img-rounded"/>
                </div>
                <div class="col-md-8 job_content_div" style="padding-left: 0;">
                    <h3 style="margin-top: 0;">{{ $company->name }}</h3>
                    <div class="row">
                        <div class="col-md-8">
                            <p style="font-size: 16px;"><i class="fa fa-map-marker fa-lg" style="color: #9a5406;" aria-hidden="true"></i>&nbsp; {{ $company->address }} /month</p>
                        </div>
                        <div class="col-md-4">
                            <p style="font-size: 16px;"><i class="fa fa-users fa-lg" style="color: #9a5406;" aria-hidden="true"></i>&nbsp; {{ $company->num_employee }} + Employee</p>
                        </div>
                    </div>
                    <div class="cut-text">{{ $company->description }}</div>
                </div>
                <div class="col-md-2 job_content_div" style="padding-left: 0;">
                    <h4 style="text-align: right;margin-top: 0; font-style: italic;"><a href="{{ route('get-company-page',['id' => $company->id]) }}">Detail</a></h4>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div style="text-align: right;padding-right: 40px;">
                {{ $companies->render() }}
            </div>
        </div>
    </div>
@endsection
