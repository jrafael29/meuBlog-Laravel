<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >

    <style>
        .card-body p img{
            background-size: cover;
            width:fit-content;
            max-width: 100%;
            height:fit-content;
            max-height: 460px;
            background-position: center;

        }
        .card-body div{
            widows: 100%;
            max-width: 90%;
            width: 100%;
            word-wrap: break-word;
            word-break: break-all;
        }
        header nav li{
            list-style: none;
        }
        .content{
            display: flex;
            flex-direction: column-reverse;
            gap: 15px;
        }
    </style>
</head>
<body class="bg-dark">
    <header class="bg-dark ">
        <div class="container ">
            <div class="container-fluid">
                    <nav class="d-flex justify-content-center py-3">
                        <li> <a class="btn text-white mx-2" href="{{ route('index') }}">Inicio</a> </li>
                        <li> <a class="btn text-white mx-2" href=" {{route('login')}} ">Entrar</a> </li>
                    </nav>
                <div class="content">
                    @yield('content')
                </div>

            </div>
        </div>
</header>

</body>
</html>
