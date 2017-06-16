@extends('layouts.master')

@section('title')
    Article Detail
@endsection
@section('script_and_style')
    <link type="text/css" rel="stylesheet" href="{{ URL::to('/css/article.css') }}"/>
    <script src="{{URL::to('js/delete_article.js')}}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8" style="padding-left: 30px">
            <div class="article_detail">
                <h2 class="head_article_detail">{{ $article->title }}</h2>
                <h5 class="time1">{{$article->updated_at}}</h5>
                <img class="img-rounded center-block img-thumbnail" src="{{ $article->image }}">
                <p class="paragraph">
                    {!!  nl2br(e($article->content)) !!}
                </p>
            </div>
            @if(Auth::guest())

            @elseif(Auth::user()->role_id == 1 && Auth::user()->id == $article->created_by)
                <div style="padding-left: 40px; font-weight: bold">
                    <a href=" {{route('edit-article',['id' => $article->id])}}"><button type="button" class="btn btn-primary btn-lg" style="width: 130px;">Edit</button></a>
                    <button type="button" class="btn btn-danger btn-lg" id="delete" style="width: 130px;">Delete</button>
                </div>
                {{-- delete article --}}
                <div class="modal fade" id="deleteArticle">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Article</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this article?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="sureDelete">Sure</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-4" style="padding-right: 50px; margin-top: 50px">
            <ul>
                <li class="list-item" style="font-size: 20px; font-family: Impact; color: #0c5582">Others<hr class="hr4"></li>
                @foreach($others as $other)
                    <li class="list-item" style="font-weight: bold"><a href="{{ route('article-detail',['id' => $other->id]) }}">{{ $other->title }}</a><hr class="hr2"></li>
                @endforeach
                <a href="{{ route('articles-list') }}"><center><button type="submit" class="btn" style="font-weight: bold; font-style: italic; background-color: #e58618; color: white; font-size: 16px"> Show more >></button></center></a>
            </ul>
        </div>
    </div>
    <script>
        var article_id = '{{$article->id}}';
        var _token = '{{ Session::token() }}';
        var urlDeleteArticle = '{{route('delete-article')}}';
        var urlArticlesList = '{{route('articles-list')}}';
    </script>
@endsection