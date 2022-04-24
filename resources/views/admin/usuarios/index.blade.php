@extends('adminlte::page')
@section('title', 'Usuarios')


@section('content_header')
    <h1>
        Meus usuarios
        <a class="btn btn-sm btn-success" href=" {{ route('registro') }} ">Novo Usuario</a>
    </h1>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover col-12">
            <tr>
                <thead>
                    <th>NOME</th>
                    <th class="d-none d-sm-block d-lg-block">EMAIL</th>
                    <th>AÇÕES</th>
                </thead>
            </tr>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{$usuario->nome}}</td>
                <td class="d-none d-sm-block d-lg-block">{{$usuario->email}}</td>
                <td >
                    <a class="btn btn-info btn-xs" href="{{ route('usuarios.edit', ['usuario' => $usuario->id]) }}">Editar</a>
                    <form class="d-inline" method="post" action="{{ route('usuarios.destroy', ['usuario' => $usuario->id]) }}" onsubmit="return confirm('deseja mesmo excluir?')">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-xs">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
{{$usuarios->links()}}
@endsection
