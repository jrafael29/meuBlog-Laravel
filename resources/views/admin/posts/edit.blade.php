@extends('adminlte::page')
@section('title', "Posts")

@section('content_header')
@endsection

@section('content')

    <div class="card">
        <div class="card-header bg-success">
            Editar Post
        </div>
        <div class="card-body">
           
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{$error}} </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form-horizontal" action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
                @csrf 
                @method('PUT')

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="titulo">Titulo</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="titulo" value="{{ $post->titulo }}" id="titulo">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="categoria">Categoria</label>
                    <div class="col-sm-4">
                       <select class="form-control" name="categoria" id="categoria">
                           <option value="{{$post->categoria}}">{{$post->categoria}}</option>
                           <option value="esporte">Esporte</option>
                           <option value="noticia">Noticia</option>
                           <option value="denuncia">Denuncia</option>
                           <option value="entretenimento">Entretenimento</option>
                       </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="corpo">Descrição</label>
                    <div class="col-sm-10">
                        <textarea class="form-control corpo" name="corpo" id="corpo" cols="30" rows="5">{{ $post->corpo }}</textarea>
                    </div>
                </div>


                <input class="btn btn-success offset-sm-2" type="submit" value="Salvar">

            </form>


        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>
    
        tinymce.init({
            selector:'textarea.corpo',
            height:300,
            menubar: false,
            
            content_style: false,
            plugins: ['link', 'table', 'image', 'autoresize', 'lists' ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft alignjustify aligncenter alignright | table | link image | bullist numlist ',
            images_upload_url: ' {{ route('imageupload') }}',
            images_upload_credentials: true,
            convert_urls:false
        })
    
    </script>

@endsection