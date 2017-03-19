@extends('layouts.master')

@section('title')
    Contact Us
@endsection

@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/contactus.css') }}">
@endsection

@section('content')
    <div class="row" style="padding: 100px;height: 717px;">
        <div class="col-md-3 phone">
            <div class="image">
                <img class="img-responsive" src="{{ Storage::url('/contactus/phone.png') }}"/>
            </div>
            <div>
                <p>(+84)123456789</p>
            </div>
        </div>
        <div class="col-md-3 phone">
            <div class="image">
                <img class="img-responsive" src="{{ Storage::url('/contactus/mail.png') }}"/>
            </div>
            <div>
                <p>recruitment_uit@gmail.com</p>
            </div>
        </div>
        <div class="col-md-3 phone">
            <div class="image">
                <img class="img-responsive" src="{{ Storage::url('/contactus/location.png') }}"/>
            </div>
            <div>
                <p>University Of Information Technology</p>
            </div>
        </div>
        <div class="col-md-3 phone">
            <div class="image">
                <img class="img-responsive" src="{{ Storage::url('/contactus/facebook.png') }}"/>
            </div>
            <div>
                <p>fb.com/recruitment_uit</p>
            </div>
        </div>
        {{--<div class="col-md-2 phone">--}}
            {{--<div class="image">--}}
                {{--<img class="img-responsive" src="{{ Storage::url('/contactus/twitter.png') }}"/>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<p>https://twitter.com/recruitment_uit</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>


@endsection