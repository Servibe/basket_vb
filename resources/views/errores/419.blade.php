<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Basket VB</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Passion+One:900" rel="stylesheet">

	<style type="text/css">
	* {
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
	}

	body {
		padding: 0;
		margin: 0;
	}

	#notfound {
		position: relative;
		height: 100vh;
	}

	#notfound .notfound {
		position: absolute;
		left: 50%;
		top: 50%;
		-webkit-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
	}

	.notfound {
		max-width: 710px;
		width: 100%;
		padding-left: 190px;
		line-height: 1.4;
	}

	.notfound .notfound-404 {
		position: absolute;
		left: 0;
		top: 0;
		width: 150px;
		height: 150px;
	}

	.notfound .notfound-404 h1 {
		font-family: 'Passion One', cursive;
		color: #00b5c3;
		font-size: 150px;
		letter-spacing: 15.5px;
		margin: 0px;
		font-weight: 900;
		position: absolute;
		left: 50%;
		top: 50%;
		-webkit-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
	}

	.notfound h2 {
		font-family: 'Raleway', sans-serif;
		color: #292929;
		font-size: 28px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 2.5px;
		margin-top: 0;
	}

	.notfound p {
		font-family: 'Raleway', sans-serif;
		font-size: 14px;
		font-weight: 400;
		margin-top: 0;
		margin-bottom: 15px;
		color: #333;
	}

	.notfound a {
		font-family: 'Raleway', sans-serif;
		font-size: 14px;
		text-decoration: none;
		text-transform: uppercase;
		background: #fff;
		display: inline-block;
		padding: 15px 30px;
		border-radius: 40px;
		color: #292929;
		font-weight: 700;
		-webkit-box-shadow: 0px 4px 15px -5px rgba(0, 0, 0, 0.3);
		box-shadow: 0px 4px 15px -5px rgba(0, 0, 0, 0.3);
		-webkit-transition: 0.2s all;
		transition: 0.2s all;
	}

	.notfound a:hover {
		color: #fff;
		background-color: #00b5c3;
	}

	@media only screen and (max-width: 480px) {
		.notfound {
			text-align: center;
		}
		.notfound .notfound-404 {
			position: relative;
			width: 100%;
			margin-bottom: 15px;
		}
		.notfound {
			padding-left: 15px;
			padding-right: 15px;
		}
	}

	</style>
</head>

<body>
	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>:(</h1>
			</div>
			<h2>419 - Página Expirada</h2>
			<p>La página a la que estas intentando acceder ha caducado.</p>
			@if(Auth::check())
			<a href="/home">Home</a>
			@else
			<a href="/">Home</a>
			@endif
		</div>
	</div>
</body>
</html>