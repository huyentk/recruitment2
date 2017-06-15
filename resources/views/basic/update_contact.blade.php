@extends('layouts.master')

@section('title')
    Contact Information
@endsection

@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/contactus.css') }}">
@endsection

@section('content')
    <div class="row" style="height: 717px;">
        <div class="col-md-6 col-md-offset-3">
            <h3 style="line-height: 50px;">Update Contact Information</h3>
            <form action="{{ route('post-update-contact') }}" method="post">
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input class="form-control" type="text" name="phone" value="{{ $contact->phone}}">
                </div>
                <div class="form-group">
                    <label for="email">Email Adress</label>
                    <input class="form-control" type="email" name="email" value="{{ $contact->email }}">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input class="form-control" type="text" name="location" value="{{ $contact->location }}">
                </div>
                <div class="form-group">
                    <label for="fb">Facebook</label>
                    <input class="form-control" type="text" name="fb" value="{{ $contact->fb }}">
                </div>
                <input type="hidden" name='_token' value="{{ Session::token() }}">
                <br/>
                <center><button class="btn" style="background-color: #124395;color: white;width: 150px;" type="submit">Submit</button></center>
            </form>
        </div>
    </div>
@endsection