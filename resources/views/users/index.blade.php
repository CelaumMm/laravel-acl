@extends('layouts.app')
@section('title', '| Users')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row">

        <h1>
            <i class="fa fa-users"></i> User Administration

            <a class="btn btn-sm btn-dark" href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>

            <a class="btn btn-sm btn-dark" href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a>
        </h1>

        <hr>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date/Time Added</th>
                        <th>User Roles</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                        <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to
                        a user and convert to string --}}

                        <td>
                            <div class="form-row">
                                <div class="col-auto">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary pull-left"><i class="fa fa-pen"></i> Edit</a>
                                </div>
                                <div class="col-auto">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!} {!! Form::button('<i class="fa fa-trash"></i> Delete', ['type'=>'submit' ,'class'
                                    => 'btn btn-sm btn-danger']) !!} {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fa fa-user-plus"></i> Add User</a>

    </div>
</div>
@endsection
