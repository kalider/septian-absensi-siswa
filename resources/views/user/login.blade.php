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
		.login{
			background-color: black;
			border-radius: 25px;
			
		}
		.title-login{
			margin-top: 30px;
			
		}
	</style>


	<!-- Custom styles for this template -->
	<link href="./assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

	<main class="form-signin w-100 m-auto login" >
		<div><form method="post" action="/login">
			@csrf
			<img class="mb-4" src="../assets/logo/logo5.png" alt="" width="300" height="100">
			

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

			<br>
			<div class="form-floating mb-2">
				<input type="text" class="form-control" id="floatingInput" placeholder="ex: budi" name="username">
				<label for="floatingInput">Username</label>
			</div>
			
			<div class="form-floating">
				<input type="password" class="form-control" id="floatingPassword" placeholder="Password"
					name="password">
				<label for="floatingPassword">Password</label>
			</div>

			<button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
			<a href="/register" class="mt-3 btn btn-link w-100">Register</a>

			
		</form></div>
		
	</main>

</body>

</html>
