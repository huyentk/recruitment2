@extends('layouts.master')

@section('title')
    Edit Company Page
@endsection

@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/student_page.css') }}">
    {{--<script type="application/javascript" src="{{ URL::to('/js/update_emp_info.js') }}"></script>--}}
@endsection

@section('content')
    <div class="row" style="padding-top: 20px;">
        <div style="padding-left: 35px;display: inline-flex">
            <p style="font-weight:bold;font-size: 25px; font-style: italic;line-height: 75px;color: #0c5582;margin-bottom: 0;">Update information of &nbsp;</p>
            <p style="font-weight:bold;font-size: 40px;color: #ea1a1e; margin-bottom: 0;">{{$company_old->name}}</p>
        </div>
        <hr style="margin-top: 0px;">
    </div>
    <form action="{{ route('update-company-page') }}" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="info">
                    <div class="form-inline">
                        <label for="banner">New Banner: </label>
                        <input type="file" name="company_banner" accept="image/png" class="form-control" style="margin-top: 5px;">                    </div>
                </div>
                <div class="info">
                    <div class="form-inline">
                        <label for="avatar">New Logo: </label>
                        <input type="file" name="company_logo" accept="image/png" class="form-control" style="margin-top: 5px;">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info">
                    <div class="form-inline">
                        <label for="address">Address: </label>
                        <textarea id="address" class="input_info form-control" name="address" rows="4">{{ $company_old->address }}</textarea>
                    </div>
                </div>
                <div class="info1">
                    <div class="form-inline">
                        <label for="num_employee" class="label1">Number of Employee: </label>
                        <input id="num_employee" class="input_info form-control" type="number" name="num_employee" value="{{ $company_old->num_employee }}"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="info2">
                <div class="form-inline">
                    <label for="major" class="label2">Company</label>
                    <input id="slogan" class="input_info form-control" type="text" name="slogan" value="{{ $company_old->slogan }}"/>
                </div>
            </div>

            <div class="info2">
                <div class="form-inline">
                    <label for="major" class="label2">Description</label>
                    <textarea id="description" class="input_info form-control" name="description" rows="15">{{ $company_old->description }}</textarea>
                </div>
            </div>
        </div>
        <center>
            <input type="submit" value="Cập nhật">
        </center>

        <input hidden value="{{ $company_old->id }}" name="company_id"/>
        <input hidden value="{{ Session::token() }}" name="_token"/>
    </form>
@endsection