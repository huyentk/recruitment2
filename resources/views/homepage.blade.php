@extends('layouts.master')

@section('title')
    Homepage
@endsection

@section('script_and_style')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/homepage.css') }}">
@endsection

@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#banner1" data-slide-to="0" class="active"></li>
            <li data-target="#banner2" data-slide-to="1"></li>
            <li data-target="#banner3" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{ Storage::url('banner/banner1.jpg') }}" alt="banner1">
            </div>

            <div class="item">
                <img src="{{ Storage::url('banner/banner2.jpg') }}" alt="banner2">
            </div>

            <div class="item">
                <img src="{{ Storage::url('banner/banner3.jpg') }}" alt="banner3">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <br/>
    <div class="above">
        <div style="padding-top: 5px;padding-left: 20px;">
            <h4>Start your search here!</h4>
            <hr style="margin-top: 0px;margin-bottom: 0px;margin-right: 20px;"/>
            <div class="row" style="margin-top: 15px;">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag" aria-hidden="true"></i></span>
                        <input type="text" id="skill_tags" class="form-control" placeholder="Search for your skill (i.e: PHP, Python,...)" name="tag">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="City..." name="city">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-warning" style="width: 135px;text-align: center;"><span class="glyphicon glyphicon-search"></span> Search</button>
                </div>
            </div>
        </div>
    </div>
@endsection
