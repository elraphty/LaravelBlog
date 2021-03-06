@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
{!! Form::open(['action'=> ['PostController@update',$post->id], 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$post->title, ['class'=>'form-control','placeholder'=>'Enter Form Title']) }}   
    </div>

    <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body', $post->body, ['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Enter Form Body']) }}   
    </div>
    <div class="form-group">
            {{ Form::file('cover_image') }}
        </div>
    <center>
        {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    </center>
{!! Form::close() !!}

@endsection