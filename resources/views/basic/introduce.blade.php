@extends('layouts.master')

@section('title')
    Introduce
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3 style="line-height: 50px; font-weight: bold">About Us</h3>
            <div>
                JFI is one of the best recruitment website in Vietnam.
            </div>
            <div>
                The website was completed in 2017 by students of University of Information Technology(UIT), Vietnam National University, HCMC.
            </div>
            <div>
                If you are company, you will can:
                <ul>
                    <li>Manage the company's profile page</li>
                    <li>Create new jobs with corresponding skills</li>
                    <li>Manage your jobs by the candidates track table</li>
                </ul>
            </div>
            <div>
                If you are student, you will can:
                <ul>
                    <li>Find a job of your favorite company</li>
                    <li>Send your resume to company to apply job</li>
                    <li>Track application result</li>
                </ul>
            </div>
            <div>Do you have any questions? Please contact us!</div>
            <h3 style="line-height: 50px; font-weight: bold">Development team</h3>
            <div class="row" style="margin: 50px">
                <div class="col-md-6">
                    <center><img src="{{ Storage::url('introduce/huyen.jpg') }}" class="img-rounded " style="width: 200px; height: 200px; border-radius: 50%;"></center>
                    <div style="text-align: center; font-size: 16px; font-family: Verdana">
                    <br>
                    Tran Khanh Huyen
                    <br>
                    Developer
                    </div>
                </div>
                <div class="col-md-6">
                    <center><img src="{{ Storage::url('introduce/tram.jpg') }}" class="" style="width: 200px; height: 200px; border-radius: 50%;"></center>
                    <div style="text-align: center; font-size: 16px; font-family: Verdana">
                        <br>
                        Nguyen Thi Ngoc Tram
                        <br>
                        Developer
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection