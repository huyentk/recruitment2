@extends('layouts.master')

@section('title')
    Introduce
@endsection

@section('content')
    <div class="row" style="height: 717px;">
        <div class="col-md-10 col-md-offset-1">
            <h3 style="line-height: 50px; font-weight: bold">About Us</h3>
            <div>
                JFI is one of the Vietnam's leading recruitment consultancies.
            </div>
            <h3 style="line-height: 50px; font-weight: bold">Development team</h3>
            <div class="col-md-4 col-md-offset-1">
                <img src="{{ Storage::url('introduce/tram.jpg') }}" class="img-rounded">
                <h5 style="text-align: center">
                <br>
                Nguyen Thi Ngoc Tram
                <br>
                Developer
                </h5>
            </div>
        </div>
    </div>

@endsection