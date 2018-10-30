@extends('layouts.app')
@section('title', '| View Post')
@section('content')

<div class="container">
    @include('includes.alerts')

    <h1>{{ $post->title }}</h1>
    <hr>
    <p class="lead">{{ $post->body }} </p>
    <hr>

    {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id] ]) !!}


    @can('edit post')
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-lg btn-primary"><i class="fa fa-pen"></i> Edit</a>
    @endcan


    @can('delete post')
    {!! Form::button('<i class="fa fa-trash"></i> Delete', ['type'=>'submit' ,'class' => 'btn btn-lg btn-danger']) !!}
    @endcan

    <a href="{{ url()->previous() }}" class="btn btn-lg btn-secondary"><i class="fas fa-undo"></i> Return</a>

    {!! Form::close() !!}

</div>
@endsection
