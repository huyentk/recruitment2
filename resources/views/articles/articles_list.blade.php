@extends('layouts.master')

@section('title')
    Articles List
@endsection

@section('script_and_style')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/article.css') }}">
@endsection

@section('content')
    <br>
    <div class="col-md-2" style="font-size: 30px; font-family: Impact;background-color: #a94442; color: #FFFFFF">JFI ARTICLE</div>
    <br><br>
    <div><hr class="hr"></div>
    @foreach($articles as $article)
        <div class="col-md-4 article_content">
            <a href="{{ route('article-detail',['id' => $article->id]) }}">
                <div class="col-md-4 col-md-offset-1">
                <br>
                <img class="image-list" src="{{ $article->image }}" class="img-rounded"/>
{{--            <div class="col-md-8 article_content_div" style="padding-left: 0;">--}}
                <p style="font-weight: bold; width: 250px; padding: 10px;" href="{{ route('article-detail',['id' => $article->id]) }}">{{ $article->title }}</p>
                {{--<h5 class="author">{{ $article->created_by->full_name.' - at '.$article->updated_at}}</h5>--}}
                {{--<h5 class="author">{{$article->updated_at}}</h5>--}}
                {{--<div class="cut-text" style="color: #0c5582">{{ $article->content }}</div>--}}
                {{--<a style="color: royalblue" href="{{ route('article-detail',['id' => $article->id]) }}"><b>See more...</b></a>--}}

                </div>
            </a>
        </div>
    @endforeach
    <div style="text-align: center">{!! $articles->links() !!}</div>
@endsection
