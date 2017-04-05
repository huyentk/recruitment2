@extends('layouts.master')

@section('title')
    Create Job
@endsection
@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/job_detail.css') }}"/>
    <script src="{{ URL::to('js/create_job.js') }}"></script>
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
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="job_detail">
                Name: <input style="margin-bottom: 20px; width:540px;" id="job_name" class="form-control input-lg" required/>
                <div class="row" id="append_skill">

                </div>
                <div class="row" style="padding: 15px;width:550px;" id="select_skill">
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
                    <input style="margin-bottom: 20px;margin-left:10px;width: 150px;" id="job_salary" class="form-control" required/> &nbsp;/month
                </div>
                @if(Auth::guest() || Auth::user()->role_id != 2)

                @elseif(Auth::user()->role_id == 2)
                    <button type="button" class="btn btn-danger btn-lg" id="create" style="width: 130px;">Create</button>
                @endif
                <hr/>
                <h3>Job Description</h3>
                <textarea class="paragraph form-control" rows="10" id="job_description" style="resize: vertical;width: 96%" required></textarea>
                <br/>
                <h3>Requirements</h3>
                <textarea class="paragraph form-control" rows="10" id="job_requirement" style="resize: vertical;width: 96%" required></textarea>
                <br/>
                <h3>Benefits</h3>
                <textarea class="paragraph form-control" rows="10" id="job_benefit" style="resize: vertical;width: 96%" required></textarea>
                <br/>
            </div>
        </div>
    </div>
    <script>
        var urlListJob = '{{ route('get-jobs-list') }}';
        var urlCreateJob = '{{ route('post-create-job') }}';
        var _token = '{{ Session::token() }}';
    </script>
@endsection