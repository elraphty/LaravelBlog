@extends('layouts.app')

@section('content')
<a href="/post" class="btn btn-default">Go Back</a>
<h1>{{$post->title}}</h1>
<img src="/storage/cover_images/{{$post->cover_image}}" class="image-responsive" style="width:100% !important;height:400px;">
<br><br>
<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>

<div>
    {!!$post->body!!}
</div>

<hr/>
@if(!Auth::guest())
@if(Auth::user()->id == $post->user_id)
<a href="/post/{{$post->id}}/edit" class="btn btn-primary ">Edit</a>

{!! Form::open(['action'=>['PostController@destroy',$post->id],'method'=>'POST','class'=>'float-right']) !!}
{{Form::hidden('_method','DELETE')}}
{{Form::submit('Delete',['class'=>'btn btn-danger'])}}
{!! Form::close() !!}
@endif
@endif
@endsection