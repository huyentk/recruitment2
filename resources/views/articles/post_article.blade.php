@extends('layouts.master')

@section('title')
    Post Article
@endsection
@section('script_and_style')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/article.css') }}" xmlns="http://www.w3.org/1999/html">
@endsection
@section('content')
    <section class="row new-post">
        <div  class="col-md-8 col-md-offset-2">
{{--            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                        @endforeach
                </div>--}}
            <form action="{{ route('add-article') }}" method="post" enctype="multipart/form-data">
                <input type = "hidden" name = "_token" value = "{{csrf_token()}}"/>
                <h2>Create a post</h2>
                <div>
                    <label>Title</label>
                    <input required class="form-control" type="text" name="title" id="title">
                </div>
                <div class="form-group">
                     <label>Content</label>
                     <textarea required class="form-control" type = "text" name="content" id="content" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image_article" accept="image/png" id="image_article">
                </div>
                <center><button type="submit" class="btn" style="background-color: #124395;color: white;width: 150px;">Post</button></center>
            </form>
        </div>
    </section>

@endsection