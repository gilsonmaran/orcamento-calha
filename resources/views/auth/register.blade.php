<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Orçamentos Calha</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>

<body class="text-center">

    <main class="form-signin w-100 m-auto">
        @if ($errors->any())
        <div class="container">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                <div>
                    <i class="fas fa-times"></i>
                    {{ $error }}
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <img class="mb-4" src="https://st4.depositphotos.com/30085714/39992/v/600/depositphotos_399920374-stock-illustration-gutter-and-house-roof-logo.jpg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Registre-se</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="name" placeholder="Nome Completo">
                <label>Nome</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" name="email" placeholder="name@example.com">
                <label>E-mail</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="password" placeholder="Senha">
                <label>Senha</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme a Senha">
                <label>Confirme a Senha</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Registre-se</button>
        </form>
    </main>



</body>

</html>

