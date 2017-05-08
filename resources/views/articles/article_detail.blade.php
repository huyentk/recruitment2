@extends('layouts.master')

@section('title')
    Article Detail
@endsection
@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/article.css') }}"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="article_detail">
                <h2 class="head_article_detail">{{ $article->title }}</h2>
                {{--<h5 class="author">{{ $article->created_by->full_name.' - at '.$article->updated_at}}</h5>--}}
                <h5 class="author">{{$article->updated_at}}</h5>
                <img class="img-rounded center-block img-thumbnail" src="{{ $article->image }}">
                <p class="paragraph">
                    {!!  nl2br(e($article->content)) !!}
                </p>
            </div>
            @if(Auth::guest())

            @elseif(Auth::user()->role_id == 1)
                <a href=" {{route('edit-article',['id' => $article->id])}}">Edit</a>
                |
                <a href=" {{route('delete-article',['id' => $article->id])}} " onclick= "return confirm('Do you want to delete this post?')">Delete</a>
            @endif
        </div>
        <div class="col-md-4">
            <br><br>
            <ul>
                <li class="list-item" style="font-size: 20px; font-family: Impact; color: #0c5582">Others<hr class="hr4"></li>
                @foreach($others as $other)
                    <li class="list-item" style="font-weight: bold"><a href="{{ route('article-detail',['id' => $other->id]) }}">{{ $other->title }}</a><hr class="hr2"></li>
                @endforeach
                <center><button type="submit" class="btn" style="font-weight: bold; font-style: italic; background-color: #e58618"><a href="{{ route('articles-list') }}" style="color: white"> Show more >></a></button></center>
            </ul>
        </div>
    </div>


{{--    <div class="col-md-4">
        <div class="row">
            <lable style="font-size: 24px;color: #2b1e9a;">Lastest Articles</lable>
            <button class="btn btn-default btn-md" type="submit" style="float: right;margin-right: 35px;">View All</button>
        </div>
        <br/>
        @foreach($articles as $article)
            <div class="row" style="padding-left: 50px;">
                <a href="#">
                    <div class="col-md-6">
                        <img class="img-rounded" style="border: 1px solid #b1b7ba;" src="{{ $article->image }}">
                        <p style="width: 220px;font-size: 16px;font-weight: bold">{{ $article->title }}</p>
                    </div>
                </a>
            </div>
            <br/>
        @endforeach
    </div>--}}


@endsection