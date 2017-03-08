@extends('layouts.master')

@section('title')
    Sign-in
@endsection

@section('content')
    <div class="row" style="height: 717px;">
        <div class="col-md-6 col-md-offset-1">
            <h3 style="line-height: 50px;">Sign in</h3>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="email">Email Adress</label>
                    <input placeholder="Enter your email" style="width: 400px;" class="form-control" type="text" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input placeholder="Enter your password" style="width: 400px;" class="form-control" type="password" name="password">
                </div>
                <input type="hidden" name='_token' value="{{ Session::token() }}">
                <br/>
                <button class="btn" style="background-color: #124395;color: white;width: 150px; margin-left: 120px;" type="submit">Sign in</button>
            </form>
        </div>
        <div class="col-md-6">
        </div>
    </div>

@endsection