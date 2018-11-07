@extends('layouts.app')
@section('title', '| Roles')
@section('content')

<div class="container">
    @include('includes.alerts')

    <h1>
        <i class="fa fa-key"></i> Roles

        <a class="btn btn-sm btn-dark" href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>

        <a class="btn btn-sm btn-dark" href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a>
    </h1>

    <hr>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>

                    {{-- Recuperar a matriz de permissões associadas a uma função e convertê-la em string --}}
                    <td>{{ $role->permissions()->pluck('name')->implode(', ') }}</td>
                    <td>
                        <div class="form-row">
                            <div class="col-auto">
                                <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-sm btn-primary pull-left" style="margin-right: 3px;"><i class="fa fa-pen"></i> Edit</a>
                            </div>
                            <div class="col-auto">
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("user.confirm")."');",
                                    'route' => ['roles.destroy', $role->id]
                                ]) !!}
                                {!! Form::button('<i class="fa fa-trash"></i> Delete', ['type'=>'submit', 'class' => 'btn btn-sm btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('roles.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Role</a>
</div>
@endsection
