@extends('layouts.master')

@section('title')
    Jobs List
@endsection

@section('script_and_style')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/homepage.css') }}">
    <script src="{{URL::to('js/search_job.js')}}"></script>
@endsection

@section('content')
    <br/>
    <div class="search">
        <div style="padding-top: 5px;padding-left: 20px;">
            <h4>Start your search here!</h4>
            <hr style="margin-top: 0px;margin-bottom: 0px;margin-right: 20px;"/>
            <form method="post" action="{{ route('post-jobs-list') }}">
                <div class="row" style="margin-top: 15px; padding-bottom: 20px;">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-tag" aria-hidden="true"></i></span>
                            <input type="text" id="skill_tags" class="form-control" placeholder="Search for your skill (i.e: PHP, Python,...)" name="skill">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i></span>
                            <input type="text" id="city" class="form-control" placeholder="City..." name="city">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button type="submit" class="btn" style="width: 135px;text-align: center;background-color: #e58618;color: white;"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @foreach($jobs as $job)
    <div class="row job_content">
        <div class="col-md-2 job_content_div">
            <img src="{{ $job->image }}" class="img-rounded"/>
        </div>
        <div class="col-md-8 job_content_div" style="padding-left: 0;">
            <h3 style="margin-top: 0;">{{ $job->name }}</h3>
            <div class="row">
                @foreach($job->skills as $job_skill)
                    <div class="col-md-4">
                        <p style="font-size: 18px;"><i class="fa fa-tag fa-lg" style="color: #9a5406;" aria-hidden="true"></i> {{ $job_skill->skill_name }}</p>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p style="font-size: 16px;"><i class="fa fa-money fa-lg" style="color: #9a5406;" aria-hidden="true"></i>&nbsp; {{ $job->salary }} /month</p>
                </div>
                <div class="col-md-4">
                    <p style="font-size: 16px;"><i class="fa fa-building fa-lg" style="color: #9a5406;" aria-hidden="true"></i>&nbsp; {{ $job->company_name }}</p>
                </div>
            </div>
            <div class="cut-text">{{ $job->description }}</div>
        </div>
        <div class="col-md-2 job_content_div" style="padding-left: 0;">
            <h4 style="text-align: right;margin-top: 0; font-style: italic;"><a href="{{ route('job_detail',['id' => $job->id]) }}">Detail</a></h4>
        </div>
    </div>
    @endforeach
    @if(!isset($do_not_render))
        <div class="row">
            <div style="text-align: right;padding-right: 40px;">
                {{ $jobs->render() }}
            </div>
        </div>
    @endif
    <script>
        var urlGetJobs = '{{ route('getJobSources') }}';
    </script>
@endsection
