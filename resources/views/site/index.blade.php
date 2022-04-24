@extends('layouts.base')
@section('title', 'Inicio')


@section('content')
{{$posts->links()}}
@foreach($posts as $post)
    <div class="card ">

        <div class="card-header">
            <h4>
                <a style="text-decoration: none" href=" {{ route('visualizar', ['slug' => $post->slug]) }} "> {{$post->titulo}} </a>
                <small class="float right"> {{$post->categoria}} </small>
            </h4>
        </div>
        <div class="card-body py-5">
            {!! $post->corpo !!}
        </div>
        <div class="card-footer">
            <small>
                <address>Publicado em {{ date('d/m/Y', strtotime($post->criadoEm)) }}</address>
            </small> 
        </div>

    </div>
@endforeach

@endsection
