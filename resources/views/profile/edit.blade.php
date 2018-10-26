@extends('layouts.app')
@section('title', '| Profile')
@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1><i class='fa fa-user-edit'></i> Profile</h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ auth()->user()->name }}" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group">
                            @if(auth()->user()->image != null)
                            <img src="{{ url('storage/users/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" style="max-width: 50px;">                            @endif

                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-block btn-success"><i class="fas fa-save"></i> Save</button>

                            <a href="{{ route('home') }}" class="btn btn-lg btn-block btn-secondary"><i class="fas fa-undo"></i> Return</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
