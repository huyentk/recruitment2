@extends('layouts.master')

@section('title')
    Sign-in
@endsection

@section('content')
    <div class="row" style="height: 717px;">
        <div class="col-md-6 col-md-offset-3">
            <h3 style="line-height: 50px;">Sign in</h3>
            <form action="{{ route('sign-in') }}" method="post">
                <div class="form-group">
                    <label for="email">Email Adress</label>
                    <input placeholder="Enter your email" class="form-control" type="text" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input placeholder="Enter your password" class="form-control" type="password" name="password">
                </div>
                <input type="hidden" name='_token' value="{{ Session::token() }}">
                <br/>
                <center><button class="btn" style="background-color: #124395;color: white;width: 150px;" type="submit">Sign in</button></center>
            </form>
            <br>
            {{--<center><a href="{{ route('auth-facebook') }}"><img src="{{ Storage::url('/facebook.png') }}"></a></center>--}}
            {{--<center><button class="btn btn-info" type="submit">Sign in with Facebook</button></center>--}}
        </div>
    </div>

@endsection