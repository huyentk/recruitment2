@extends('layouts.master')

@section('title')
    Articles List
@endsection

@section('script_and_style')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/article.css') }}">
@endsection

@section('content')
    <div>
        <h2 class="head_post">Job's Articles List</h2>
    </div>
    <div class="row" style="margin-left: 20px; margin-right: 20px">
        @foreach($articles as $article)
            <div class="col-md-4">
                <div style="margin-top: 20px;">
                    <img class="image-list img-rounded center-block" src="{{ $article->image }}"/>
                </div>
                <div class="cut-text1" style="font-weight: bold;  padding-left: 30px; padding-right: 30px; padding-top: 15px; padding-bottom: 15px;height: 40px" >
                    <a href="{{ route('article-detail',['id' => $article->id]) }}">{{ $article->title }}</a>
                </div>
                <div class="cut-text" style="color: #0c5582; padding-left: 30px; padding-right: 30px">{{$article->content}}</div>
                <hr class="hr1" width="90%">
            </div>
        @endforeach
    </div>

    <div style="text-align: center">{!! $articles->links() !!}</div>
@endsection
