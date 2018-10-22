@extends('layouts.app')

@section('content')

<div class="container">
    @include('includes.alerts')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Meu perfil</div>
                
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" value="{{ auth()->user()->name }}" name="name" placeholder="Nome" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" value="{{ auth()->user()->email }}" name="email" placeholder="E-mail" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" name="password" placeholder="Senha" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            @if(auth()->user()->image != null)
                                <img src="{{ url('storage/users/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" style="max-width: 50px;">
                            @endif
                            
                            <label for="image">Imagem</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
