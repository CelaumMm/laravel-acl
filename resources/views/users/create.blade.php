@extends('layouts.app')
@section('title', '| Add User')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1><i class='fa fa-user-plus'></i> Add User</h1>
                </div>

                <div class="card-body">
                    {{ Form::open(['url' => 'users']) }}
                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', '', ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', '', ['class' => 'form-control']) }}
                        </div>

                        <div class='form-group'>
                            @foreach ($roles as $role)
                                {{ Form::checkbox('roles[]', $role->id ) }}
                                {{ Form::label($role->name, ucfirst($role->name)) }}
                                <br>
                            @endforeach
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}<br>
                            {{ Form::password('password', ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Confirm Password') }}<br>
                            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                        </div>

                        {{ Form::button('<i class="fas fa-save"></i> Add', ['type' => 'submit','class' => 'btn btn-success']) }}
                        <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fas fa-undo"></i> Return</a>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
