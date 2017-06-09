@extends('layouts.master')

@section('title')
    Student Page
@endsection

@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/student_page.css') }}">
    <script type="application/javascript" src="{{ URL::to('/js/update_stu_info.js') }}"></script>
@endsection

@section('content')
    {{--Account Information--}}
    <div class="row">
        <div class="col-md-4" id="avatar">
            <form action="" enctype="multipart/form-data" method="post" id="file_upload">
                <img id="ava" class="img-responsive img-circle" src="{{ $student_info->image }}"/>
                <input type="file" name="update_ava" accept="image/png" class="form-control" style="margin-top: 5px;" id="update_ava">
                <input hidden value="{{ Session::token() }}" name="_token"/>
                <center><input type="submit" class="form-control" id="button_update"></center>
            </form>
        </div>
        <div class="col-md-7" id="account_info">
            <h2>Account Information</h2>
            <hr/>
            <div class="update_and_save">
                <h5 style="font-style: italic;">Update your account information details here</h5>
                <h5 id="h2_2">
                    <span>
                        <a id="save-account-info" href="" ><i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> Save changes</a>
                    </span>
                </h5>
            </div>
            <div class="info">
                <div class="form-inline">
                    <label for="fullname">Fullname</label>
                    <input id="full_name" class="input_info form-control" type="text" name="full_name" value="{{ $student_info->full_name }}"/>
                </div>
            </div>
            <div class="info">
                <div class="form-inline">
                    <label for="email">Email</label>
                    <input id="email" class="input_info form-control" type="email" name="email" value="{{ $student_info->email }}"/>
                </div>
            </div>
            <div class="info">
                <div class="form-inline">
                    <label for="currentPassword">Current Password</label>
                    <input class="input_info form-control" id="current-pass" type="password" name="current_password" value="{{ $student_info->password }}"/>
                </div>
            </div>
            <div class="info">
                <div class="form-inline">
                    <label for="newPassword">New Password</label>
                    <input id="new_pass" class="input_info form-control" type="password" name="new_password" placeholder="Enter your new password to change it.."/>
                </div>
            </div>
            <div class="info">
                <div class="form-inline">
                    <label for="confirmPassword">Confirm New Password</label>
                    <input id="confirm_pass" class="input_info form-control" type="password" name="confirm_password" placeholder="Confirm your new password.."/>
                </div>
            </div>
        </div>
    </div>
    {{--Personal Details--}}
    <div class="row">
        <div class="col-md-11" style="margin-left: 30px;">
            <div id="account_info">
                <h2>Personal Details</h2>
                <hr/>
                <div class="update_and_save">
                    <h5 id="h2_1" style="font-style: italic;">Update your personal details here</h5>
                    <h5 id="h2_2"><span><a id="save-personal-detail" href="" ><i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> Save changes</a></span></h5>
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <div class="form-inline">
                            <label for="gender">Gender</label>
                            <form class="input_info" style="float:right;">
                                <label class="radio-inline"><input type="radio" name="gender" <?php if($student_info->gender == 0) echo "checked"?> value="0" /> Male</label>
                                <label class="radio-inline"><input type="radio" name="gender" <?php if($student_info->gender == 1) echo "checked"?> value="1" />Female</label>
                            </form>
                        </div>
                    </div>
                    <div class="info">
                        <div class="form-inline">
                            <label for="university">University</label>
                            <input id="university" class="input_info form-control" type="text" name="university" value="{{ $student_info->university->university }}"/>
                        </div>
                    </div>
                    <div class="info">
                        <div class="form-inline">
                            <label for="major">Major</label>
                            <input id="major" class="input_info form-control" type="text" name="major" value="{{ $student_info->university->major }}"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <div class="form-inline">
                            <label for="address">Address</label>
                            <textarea id="address" class="input_info form-control" name="address">{{ $student_info->address }}</textarea>
                        </div>
                    </div>
                    <div class="info">
                        <div class="form-inline">
                            <label for="phone">Phone</label>
                            <input id="phone" class="input_info form-control" type="text" name="phone" value="{{ $student_info->phone }}"/>
                        </div>
                    </div>
                    <div class="info">
                        <div class="form-inline">
                            <label for="skypeId">Skype ID</label>
                            <input id="skypeId" class="input_info form-control" type="text" name="skype_id" value="{{ $student_info->skype_id }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Jobs Management--}}
    <div class="row">
        <div class="col-md-11" style="margin-left: 30px;">
            <div id="account_info">
                <h2>Jobs Management</h2>
                <hr/>
                <center>
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Job's Name</th>
                            <th>Registered at</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                        @foreach($jobs as $job)
                            <tr>
                                <td></td>
                                <td>{{ $job->name }}</td>
                                <td>{{ $job->apply_at }}</td>
                                <td>{{ $job->result }}</td>
                                <td><a href="{{ route('job_detail',['id' => $job->id]) }}">Detail >></a> </td>
                            </tr>
                        @endforeach
                    </table>
                </center>
            </div>
        </div>
    </div>
    <script>
        var _token = '{{ Session::token() }}';
        var urlChangeAccountInfo_noPass = '{{ route('update-account-info-no-pass') }}';
        var urlChangeAccountInfo_hasPass = '{{ route('update-account-info-has-pass') }}';
        var urlChangePersionalDetail = '{{ route('update-persional-detail') }}';
        var url_student_page = '{{ route('get-student-page',['id'=>Auth::user()->id]) }}';
        var urlSaveAva = '{{ route('update-ava') }}';
    </script>
@endsection