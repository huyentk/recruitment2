@extends('layouts.master')

@section('title')
    Post Article
@endsection
@section('script_and_style')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/article.css') }}" xmlns="http://www.w3.org/1999/html">
@endsection
@section('content')
    <br>
    <div class="col-md-3" style="font-size: 30px; font-family: Impact;background-color: #a94442; color: #FFFFFF">CREATE NEW POST</div>
    <br><br>
    <div><hr class="hr"></div>
    <section class="row new-post">
        <div  class="col-md-10 col-md-offset-1">
            <form action="{{ route('submit-article') }}">
                {{--<h2 class="head_post" style="text-align: center">Create a post</h2>--}}
                <div>
                    <label>Title</label>
                    <input required class="form-control" type="text" name="title" id="title">
                </div>
                <div class="form-group">
                     <label>Content</label>
                     <textarea required class="form-control" name="new-post" id="new-post" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
            </form>
        </div>
    </section>
@endsection