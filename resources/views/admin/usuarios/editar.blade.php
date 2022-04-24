@extends('adminlte::page')
@section('title', 'Editar')

@section('content_header')
    <h1>Editar usuario</h1>
@endsection

@section('content')

    <div class="card">
        
        <div class="card-header bg-info">
            Editar usuario
        </div>
        <form class="form-horizontal" method="POST" action="{{route('usuarios.update', ['usuario' => $usuario->id])}}">
            @method('PUT')
            @csrf 
            
            <div class="card-body">

                
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                @endforeach
            </ul>
            </div>    
            @endif
            @if(session('warning'))
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <li> {{ session('warning') }} </li>
                </div>
            @endif    
                
                

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="name">Nome</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nome" value="{{$usuario->nome}} " id="name">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" value="{{$usuario->email}}" id="email">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label" for="password">Nova Senha</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label" for="passwordc">Confirmar Senha</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password_confirmation" id="passwordc">
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <button class="btn btn-info offset-sm-2">Salvar</button>
            </div>
    
    
        </form>
        
        
    </div>
    

@endsection