@extends('layouts.app')
@section('title', '| Permissions')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row">
        <h1>
            <i class="fa fa-key"></i> Available Permissions

            <a class="btn btn-sm btn-dark" href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>

            <a class="btn btn-sm btn-dark" href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
        </h1>

        <hr>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Permissions</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <div class="form-row">
                                <div class="col-auto">
                                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-sm btn-primary pull-left"><i class="fa fa-pen"></i> Edit</a>
                                </div>
                                <div class="col-auto">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i> Delete', ['type'=>'submit' ,'class'
                                    => 'btn btn-sm btn-danger']) !!} {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ URL::to('permissions/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Permission</a>
    </div>
</div>

@endsection
