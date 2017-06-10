@extends('layouts.master')

@section('title')
    Create Company Information
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3 style="line-height: 50px;">Create New Company</h3>
            <form action="{{ route('post-create-company') }}" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Slogan</label>
                    <input class="form-control" type="text" name="slogan">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input placeholder="http://vietnamesports.vn/" class="form-control" type="url" name="url">
                </div>
                <div class="form-group">
                    <label for="num_employee">Number of Employee</label>
                    <input class="form-control" type="number" name="num_employee">
                </div>
                <input type="hidden" name='_token' value="{{ Session::token() }}">
                <br/>
                <center><button class="btn" style="background-color: #124395;color: white;width: 150px;" type="submit">Create</button></center>
            </form>
        </div>
    </div>
@endsection