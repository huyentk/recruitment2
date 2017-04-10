@extends('layouts.master')

@section('title')
    Job Detail
@endsection
@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/register_job.css') }}"/>
    <script src="{{ URL::to('/js/register_job.js') }}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div style="padding-bottom: 15px;">
                <h2>Ready to send!</h2>
            </div>
            <h4 style="color: #0c5582;">What skills, work projects or achievements make you a strong candidate for this position?</h4>
            <h4>(Should not be empty)</h4>
            <textarea class="form-control" rows="4" style="width: 95%" id="intro"></textarea>

            <div style="padding-top: 15px;">
                <h3>Your information</h3>
                <hr style="margin-top: 0px;margin-bottom: 0px;"/>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-inline">
                        <label>Full name: </label>
                        <label id="full_name">&nbsp;{{ $student_info->full_name }}</label>
                    </div>
                    <div class="form-inline">
                        <label>Gender: </label>
                        @if($student_info->gender == 1)
                            <label id="gender">&nbsp; Female</label>
                        @else
                            <label id="gender">&nbsp; Male</label>
                        @endif
                    </div>
                    <div class="form-inline">
                        <label>University: </label>
                        <label id="university">&nbsp; {{ $student_info->university->university }}</label>
                    </div>
                    <div class="form-inline">
                        <label>Major: </label>
                        <label id="major">&nbsp; {{ $student_info->university->major }}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-inline">
                        <label>Birthday:&nbsp;</label>
                        <label id="birthday">{{ date("d-m-Y",strtotime($student_info->birthday)) }}</label>
                    </div>
                    <div class="form-inline">
                        <label>Email:&nbsp;</label>
                        <label id="email">{{ $student_info->email }}</label>
                    </div>
                    <div class="form-inline">
                        <label>Phone: </label>
                        <label id="phone">&nbsp; {{ $student_info->phone }}</label>
                    </div>
                    <div class="form-inline">
                        <label>Address: </label>
                        <label id="address">&nbsp; {{ $student_info->address }}</label>
                    </div>
                    <div class="form-inline">
                        <label>Skype ID: </label>
                        <label id="skype_id">&nbsp; {{ $student_info->skype_id }}</label>
                    </div>
                </div>
            </div>
            <div style="padding-top: 15px;">
                <h3>GPA and CV</h3>
                <hr style="margin-top: 0px;margin-bottom: 0px;"/>
            </div>
            <form enctype="multipart/form-data" id="file_upload" action="">
                <div class="row row1" >
                    <div class="form-inline">
                        <label>GPA file:&nbsp; </label>
                        <input type="file" class="form-control" accept="application/pdf" name="gpa">
                    </div>
                </div>
                <div class="row row1">
                    <div class="form-inline">
                        <label>CV file:&nbsp;</label>
                        <input type="file" class="form-control" accept="application/pdf" name="cv">
                    </div>
                </div>
                <input hidden value="{{ $job_id }}" name="job_id"/>
                <input hidden value="{{ Session::token() }}" name="_token"/>
            </form>

        </div>
        <div class="col-md-3" style="padding-top: 100px;">
            <img class="img-responsive" src="{{ Storage::url('/tenlua2.png') }}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8" style="text-align: center;margin-top: 15px;">
            <button id="buttonsend" type="submit" class="btn btn-primary">Send my profile</button>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="ConfirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Register</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to register this job ?&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sure">Sure</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        var job_url = '{{ route('job_detail',['id'=>$job_id]) }}';
        var job_id = '{{ $job_id }}';
        var urlSaveFile = '{{ route('post-save-file') }}';
        var urlSendMail = '{{ route('post-register-job') }}';
        var _token = '{{ Session::token() }}';
    </script>
@endsection