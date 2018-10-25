@extends('layouts.app')
@section('title', '| Create New Post')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1><i class='fa fa-newspaper'></i> Create New Post</h1>
                </div>

                <div class="card-body">
                    {{ Form::open(array('route' => 'posts.store')) }}

                    <div class="form-group">
                        {{ Form::label('title', 'Title') }} {{ Form::text('title', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('body', 'Post Body') }} {{ Form::textarea('body', null, array('class' => 'form-control')) }}
                    </div>

                    {{ Form::button('<i class="fas fa-save"></i> Save', ['type' => 'submit','class' => 'btn btn-success btn-lg
                    btn-block']) }}

                    <a href="{{ route('home') }}" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-undo"></i> Return</a>                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
