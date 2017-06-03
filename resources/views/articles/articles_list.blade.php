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
    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-4">
                <div style="margin: 10px;">
                    <img class="image-list img-rounded center-block" src="{{ $article->image }}"/>
                </div>
                <div style="padding:10px;">
                    <a style="font-weight: bold; " href="{{ route('article-detail',['id' => $article->id]) }}">{{ $article->title }}</a>
                </div>
                <div class="cut-text" style="color: #0c5582">
                    <p style="padding-right: 15px;padding-left: 15px;">{{ $article->content }}</p>
                </div>
                {{--            <div class="col-md-8 article_content_div" style="padding-left: 0;">--}}
                {{--<a style="font-weight: bold; width: 100%; padding: 10px;" href="{{ route('article-detail',['id' => $article->id]) }}">{{ $article->title }}</a>--}}
                {{--<h5 class="author">{{ $article->created_by->full_name.' - at '.$article->updated_at}}</h5>--}}
                {{--<h5 class="author">{{$article->updated_at}}</h5>--}}
                {{--<div class="cut-text" style="color: #0c5582">{{ $article->content }}</div>--}}
                {{--<a style="color: royalblue" href="{{ route('article-detail',['id' => $article->id]) }}"><b>See more...</b></a>--}}
            </div>
        @endforeach
    </div>

    <div style="text-align: center">{!! $articles->links() !!}</div>
@endsection
