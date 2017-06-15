@extends('layouts.master')

@section('title')
    Sign-up
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger" style="padding: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row" style="height: 717px;">
        <div class="col-md-6 col-md-offset-3">
            <h3 style="line-height: 50px;">Sign up</h3>
            <form action="{{ route('sign-up') }}" method="post">
                <div class="form-group">
                    <label for="email">Fullname</label>
                    <input placeholder="Enter your fullname" class="form-control" type="text" name="fullname">
                </div>
                <div class="form-group">
                    <label for="email">Email Adress</label>
                    <input placeholder="Enter your email" class="form-control" type="text" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input placeholder="Enter your password" class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input placeholder="Enter your password" class="form-control" type="password" name="password-confirm">
                </div>
                <input type="hidden" name='_token' value="{{ Session::token() }}">
                <br/>
                <center><button class="btn" style="background-color: #124395;color: white;width: 150px;" type="submit">Sign up</button></center>
            </form>
        </div>
    </div>

@endsection