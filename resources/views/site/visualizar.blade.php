@extends('layouts.base')
@section('title',)
    {{$post->titulo}}
@endsection

@section('cabecalho')
    <a class="text-dark" href="/">BLOG do Rafa</a>
    
@endsection

@section('content')
    <div class="card">

        <div class="card-header">
            <h4>
                {{$post->titulo}}
            </h4>
        </div>
        <div class="card-body py-5">
            {!! $post->corpo !!}
        </div>
        <div class="card-footer">
            <small>
                <address>Publicado em {{$post->criadoEm}}</address>
            </small> 
        </div>

    </div>
@endsection