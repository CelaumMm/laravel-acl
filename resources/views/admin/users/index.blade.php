@extends('layouts.app')
@section('title', '| Users')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row">

        <h1>
            <i class="fa fa-users"></i> @lang('user.user_management')

            <a class="btn btn-sm btn-dark" href="{{ route('admin.roles.index') }}" class="btn btn-default pull-right">
                @lang('user.roles')
            </a>

            <a class="btn btn-sm btn-dark" href="{{ route('admin.permissions.index') }}" class="btn btn-default pull-right">
                @lang('user.permissions')
            </a>
        </h1>

        <hr>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@lang('user.name')</th>
                        <th>@lang('user.email')</th>
                        <th>@lang('user.created_at')</th>
                        <th>@lang('user.user_roles')</th>
                        <th>@lang('user.operations')</th>
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
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary pull-left"><i class="fa fa-pen"></i> @lang('user.edit')</a>
                                </div>
                                <div class="col-auto">
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("user.confirm")."');",
                                        'route' => ['admin.users.destroy', $user->id]
                                    ]) !!}

                                    {!! Form::button('<i class="fa fa-trash"></i> ' . trans("user.delete"), ['type'=>'submit' ,'class' => 'btn btn-sm btn-danger']) !!}

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn btn-success"><i class="fa fa-user-plus"></i> @lang('user.add_user')</a>

    </div>
</div>
@endsection
