@extends('layouts.app')

@section('content')
<h1>Posts</h1>
@if(count($posts) > 0)
@foreach($posts as $post)
<div class="card card-body card-inverse">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <img src="/storage/cover_images/{{$post->cover_image}}" class="image-responsive" style="width:100% !important;height:150px;">
        </div>
        <div class="col-md-8 col-sm-8">
                <h3><a href="/post/{{$post->id}}">{{$post->title}}</a></h3>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
        </div>
    </div>

    </div>
@endforeach
{{$posts->links()}}
@endif

@endsection