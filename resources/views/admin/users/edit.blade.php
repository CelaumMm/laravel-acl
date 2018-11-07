@extends('layouts.app')
@section('title', '| Edit User')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1><i class='fa fa-user-edit'></i> Edit {{$user->name}}</h1>
                </div>
                <div class="card-body">

                    {{-- Form model para preencher automaticamente nossos campos com dados do usuário --}}
                    {{ Form::model($user, array('route' => array('admin.users.update', $user->id), 'method' => 'PUT')) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, array('class' => 'form-control')) }}
                    </div>

                    <h5><b>Give Role</b></h5>

                    <div class='form-group'>
                        @foreach ($roles as $role)
                            {{ Form::checkbox('roles[]', $role->id, $user->roles ) }}
                            {{ Form::label($role->name, ucfirst($role->name)) }}
                            <br>
                        @endforeach
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}<br>
                        {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Confirm Password') }}<br>
                        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                    </div>

                    {{ Form::button('<i class="fas fa-save"></i> Save', [
                        'type' => 'submit',
                        'class' => 'btn btn-lg btn-block
                        btn-success'
                    ]) }}

                    <a href="{{ route('admin.users.index') }}" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-undo"></i> Return</a>                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
