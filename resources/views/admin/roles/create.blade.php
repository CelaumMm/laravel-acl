@extends('layouts.app')
@section('title', '| Add Role')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1><i class='fa fa-key'></i> Add Role</h1>
                </div>

                <div class="card-body">

                    {{ Form::open(array('url' => route('admin.roles.store'))) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>

                        <h5><b>Assign Permissions</b></h5>

                        <div class='form-group'>
                            @foreach ($permissions as $permission)
                                {{ Form::checkbox('permissions[]', $permission->id ) }}
                                {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                            @endforeach
                        </div>

                        {{ Form::button('<i class="fas fa-save"></i> Save', [
                            'type' => 'submit',
                            'class' => 'btn btn-success btn-lg btn-block'
                        ]) }}

                        <a href="{{ route('admin.roles.index') }}" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-undo"></i> Return</a>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
