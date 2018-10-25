@extends('layouts.app')
@section('title', '| Edit Role')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1><i class='fa fa-key'></i> Edit Role: {{$role->name}}</h1>
                </div>
                <div class="card-body">

                    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Role Name') }} {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    <h5><b>Assign Permissions</b></h5>
                    @foreach ($permissions as $permission) {{Form::checkbox('permissions[]', $permission->id, $role->permissions ) }} {{Form::label($permission->name,
                    ucfirst($permission->name)) }}<br> @endforeach
                    <br> {{ Form::button('<i class="fas fa-save"></i> Save', ['type' => 'submit','class' => 'btn btn-lg btn-block
                    btn-success']) }}

                    <a href="{{ route('roles.index') }}" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-undo"></i> Return</a>                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
