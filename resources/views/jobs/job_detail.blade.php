@extends('layouts.master')

@section('title')
    Job Detail
@endsection
@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/job_detail.css') }}"/>
    <script src="{{ URL::to('js/accept_reject.js') }}"></script>
    <script src="{{ URL::to('js/edit_job.js') }}"></script>
    <script src="{{ URL::to('js/delete_job.js') }}"></script>
@endsection
@section('content')
    <div class="front"></div>
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
            <div>
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
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
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
                        <button type="button" class="btn btn-danger btn-lg" id="delete" style="width: 130px;">Delete</button>
                    @endif
                @elseif(Auth::user()->role_id == 1)

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
            <table class="table table-striped" id="table">
                <thead style="text-align: center">
                    <tr>
                        <th class="col-md-3">Full Name</th>
                        <th class="col-md-4">University</th>
                        <th class="col-md-3">Major</th>
                        <th class="col-md-2">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students_apply_job as $student_apply_job)
                        <tr id="{{ $student_apply_job->id }}">
                            <td>{{ $student_apply_job->fullname }}</td>
                            <td>{{ $student_apply_job->university }}</td>
                            <td>{{ $student_apply_job->major }}</td>
                            <td style="text-align: center;">
                                @if($student_apply_job->result == 10)
                                    <i class="fa fa-check-circle fa-2x fa-icon-button" id='accept' style="color: green; padding-right: 35px;" aria-hidden="true"></i>
                                    <i class="fa fa-times-circle fa-2x fa-icon-button" id='reject' style="color: red" aria-hidden="true"></i>
                                @elseif($student_apply_job->result == 12)
                                    Accepted!&nbsp;<i class="fa fa-times-circle fa-2x fa-icon-button" id='end' style="color: blue" aria-hidden="true"></i>
                                @elseif($student_apply_job->result == 11)
                                    Rejected!
                                @elseif($student_apply_job->result == 13)
                                    Finished!
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    {{--for accept--}}
    <div class="modal fade" tabindex="-1" role="dialog" id="ConfirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Register</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure to accept this student?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sure">Sure</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{--for reject--}}
    <div class="modal fade" tabindex="-1" role="dialog" id="RejectModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Register</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure to reject this student?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sureReject">Sure</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{--for end--}}
    <div class="modal fade" tabindex="-1" role="dialog" id="EndModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">End Process</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure to end this intership?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sureEnd">Sure</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{--for delete job--}}
    <div class="modal fade" tabindex="-1" role="dialog" id="DeleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Job</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this job?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sureDelete">Sure</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <script>
        var urlJobDetail = '{{ route('job_detail',['id'=>$job->id]) }}';
        var urlUpdateJob = '{{ route('post-update-job') }}';
        var job_id = '{{ $job->id }}';
        var _token = '{{ Session::token() }}';
        var urlAccept = '{{ route('accept-join') }}';
        var urlReject = '{{ route('reject-join') }}';
        var urlEnd = '{{ route('end-join') }}'
        var urlDeleteJob = '{{ route('delete-job') }}';
        var urlJobManagement = '{{ route('get-job-management') }}';
    </script>
@endsection