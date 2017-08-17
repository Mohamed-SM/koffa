@extends('layouts.app')

@section('title', '| View Shop')

@section('content')

<div class="container">

    <h1>{{ $post->title }}</h1>
    <br>
    <h1>{{ $post->address }}</h1>
    <hr>
    <p class="lead">{{ $post->description }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Post')
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Post')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection