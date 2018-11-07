@extends('layouts.app')
@section('title', '| Edit Permission')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1><i class='fa fa-key'></i> Edit Permission: {{$permission->name}}</h1>
                </div>
                <div class="card-body">
                    {{ Form::model($permission, array('route' => array('admin.permissions.update', $permission->id), 'method' => 'PUT')) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Permission Name') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    @if(!$roles->isEmpty())
                        <h4>Assign Permission to Roles</h4>

                        @foreach ($roles as $role)
                            {{ Form::checkbox('roles[]', $role->id ) }} {{ Form::label($role->name, ucfirst($role->name)) }} <br>
                        @endforeach
                    @endif

                    {{ Form::button('<i class="fas fa-save"></i> Save', ['type' => 'submit','class' => 'btn btn-lg btn-block btn-success']) }}

                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-undo"></i> Return</a>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
