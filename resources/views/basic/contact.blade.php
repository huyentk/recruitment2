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
                <p>{{ $contact->phone }}</p>
            </div>
        </div>
        <div class="col-md-3 phone">
            <div class="image">
                <img class="img-responsive" src="{{ Storage::url('/contactus/mail.png') }}"/>
            </div>
            <div>
                <p>{{ $contact->email }}</p>
            </div>
        </div>
        <div class="col-md-3 phone">
            <div class="image">
                <img class="img-responsive" src="{{ Storage::url('/contactus/location.png') }}"/>
            </div>
            <div>
                <p>{{ $contact->location }}</p>
            </div>
        </div>
        <div class="col-md-3 phone">
            <div class="image">
                <img class="img-responsive" src="{{ Storage::url('/contactus/facebook.png') }}"/>
            </div>
            <div>
                <p>{{ $contact->fb }}</p>
            </div>
        </div>
    </div>


@endsection