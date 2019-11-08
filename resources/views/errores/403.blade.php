<!doctype html>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Basket VB</title>
	<link rel="shortcut icon" href="{{{ asset('images/Logo/Icono.png') }}}">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" />
</head>

<body class="bg-dark text-white py-5">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-2 text-center">
				<p><i class="fa fa-exclamation-triangle fa-5x"></i><br/>Status Code: 403</p>
			</div>
			<div class="col-md-10">
				<h3>OPPSSS!!!! Lo siento...</h3>
				<p>Lo sentimos, su acceso ha sido rechazado debido a razones de seguridad de nuestro servidor y también a nuestros datos confidenciales.<br/>Por favor, vuelva a la página anterior para continuar navegando.</p>
				<!-- <a class="btn btn-danger" href="javascript:history.back()">Volver</a> -->
				<a class="btn btn-danger" href="{{ URL::previous() }}">Volver</a>
			</div>
		</div>
	</div>
</body>
</html>