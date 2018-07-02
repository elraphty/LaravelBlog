@extends('layouts.app')

@section('content')
<h1>Create Post</h1>

{!! Form::open(['action'=> 'PostController@store', 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title', '', ['class'=>'form-control','placeholder'=>'Enter Form Title']) }}   
    </div>

    <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body', '', ['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Enter Form Body']) }}   
    </div>
    <div class="form-group">
    
        {{ Form::file('cover_image') }}
        
    </div>
    <center>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    </center>
{!! Form::close() !!}

@endsection
