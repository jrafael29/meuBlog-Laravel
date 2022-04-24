@extends('adminlte::page')
@section('title', "Posts")

@section('content_header')
    <h1>
        Lista de Posts
        <a class="btn btn-success btn-sm" href="{{ route('posts.create') }}">Novo Post</a>
    </h1>
@endsection

@section('content')

    <div class="card">
        <div class="card-header bg-info">
            Meus posts
        </div>
        <div class="card-body">

            <table class="table">
                <tr>
                    <thead>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>AÇÕES</th>
                    </thead>
                </tr>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <a href="{{ route('visualizar', ['slug' => $post->slug]) }} ">{{$post->titulo}}</a>
                            </td>
                            <td> {{ucwords($post->categoria)}} </td>
                            <td>
                                <a class="btn btn-xs btn-info" href=" {{route('posts.edit', ['post' => $post->id])}} ">Editar</a>
                                <form class="d-inline" action="{{route('posts.destroy', ['post' => $post->id])}}" method="post" onsubmit="return confirm('deseja mesmo excluir o post {{$post->titulo}}?')">
                                    @csrf 
                                    @method('DELETE')
                                    <input class="btn btn-xs btn-danger" type="submit" value="Excluir">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {{$posts->links()}}

@endsection