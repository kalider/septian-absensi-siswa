<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>{{ $title }}</title>

    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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
        .register{
            background-color: black;
            border-radius: 25px;
        }
        .register h1{
            color: silver;
        }
        .form-label{
            color: silver;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="./assets/css/signin.css" rel="stylesheet">
</head>

<body>

    <main class="form-register w-100 m-auto register">
        <form method="post" action="/register">
            @csrf
            
            <div class="text-center">
            <img class="mb-4" src="../assets/logo/logo5.png" alt="" width="200" height="75">
                <h1 class="h3 mb-3 fw-normal "><B>{{$title}}</B></h1>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (isset($error))
            <div class="alert alert-danger">{{$error}}</div>
            @endif

            @if (isset($success))
            <div class="alert alert-success">{{$success}}</div>
            <a href="/login" class="w-100 btn btn-lg btn-success">Ke halaman Login</a>
            @else
            <div class="mb-3">
                <label for="nameInput" class="form-label">Fullname</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Fullname" name="name" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="usernameInput" class="form-label">Username</label>
                <input type="text" class="form-control" id="usernameInput" placeholder="Username" name="username" value="{{ old('username') }}">
            </div>
            <div class="mb-3">
                <label for="emailAddressInput" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailAddressInput" placeholder="name@example.com"
                    name="email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password">
            </div>
            <div class="mb-3">
                <label for="passwordConfirmInput" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="passwordConfirmInput" placeholder="Confirm Password"
                    name="password_confirmation">
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <a href="/login" class="mt-3 btn btn-link w-100">Ke halaman Login</a>
            @endif
        </form>
    </main>

</body>

</html>
