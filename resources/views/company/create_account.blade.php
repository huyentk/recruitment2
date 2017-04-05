@extends('layouts.master')

@section('title')
    Sign-up
@endsection

@section('content')
    <div class="row" style="height: 717px;">
        <div class="col-md-6 col-md-offset-3">
            <h3 style="line-height: 50px;">Sign up for Employee</h3>
            <form action="{{ route('create-company-account') }}" method="post">
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
                <div class="form-group">
                    <label for="department">Department</label>
                    <input placeholder="Enter your department" class="form-control" type="text" name="department">
                </div>
                <div class="form-group">
                    <label for="company">Company</label>
                    <select class="form-control" name="company">
                        <option value="1">Vietnam Esports</option>
                        <option value="2">FPT</option>
                        <option value="3">Framgia</option>
                        <option value="4">Arrow County Supplies</option>
                        <option value="5">ABC</option>
                        <option value="6">XYZ</option>
                    </select>
                </div>
                <input type="hidden" name='_token' value="{{ Session::token() }}">
                <br/>
                <center><button class="btn" style="background-color: #124395;color: white;width: 150px;" type="submit">Sign up</button></center>
            </form>
        </div>
    </div>

@endsection