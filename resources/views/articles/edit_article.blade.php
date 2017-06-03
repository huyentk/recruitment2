@extends('layouts.master')

@section('title')
    Edit Article
@endsection
@section('script_and_style')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/article.css') }}" xmlns="http://www.w3.org/1999/html">
@endsection
@section('content')
    <section class="row new-post">
        <div  class="col-md-8 col-md-offset-2">
            <form action="{{ route('update-article') }}">
                <h2>Edit article</h2>
                <div>
                    <label>Title</label>
                    <input required class="form-control" type="text" name="title" id="title" value="{{ $article->title }}">
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea required class="form-control" name="new-post" id="new-post" rows="10" value="$article->content"></textarea>
                </div>
                <div class="form-group">
                    <label>Image</label>
{{--                    <input type="file" name="image" id="image">--}}
                </div>
                <center><button type="submit" class="btn" style="background-color: #124395;color: white;width: 150px;">Update</button></center>
            </form>
        </div>
    </section>
@endsection