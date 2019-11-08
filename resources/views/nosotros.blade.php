@extends("../layout.plantilla_footer")

<!doctype html>

<html>
@include('layout.plantilla_css')

<body>
	@include('layout.plantilla_header')

	@include('layout.plantilla_nav')
	
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="contenido" id="contenido">
					<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
					<link rel="stylesheet" href="css/estilos.css" type="text/css">

					<div class="oferta"><strong>QUIENES SOMOS</strong></div>
					<div class="divformulario"><hr>
						<p class="text-monospace"><span class="resaltogris"><strong>Basket VB, da lugar a una tienda online mediante la cuál, tú como cliente nuestro que eres, podrás tener acceso a todo tipo de contenido relacionado con el mundo del baloncesto.</strong></span></p>

						<p class="text-monospace">En la tienda encontrar&aacute;s los productos que quieras conseguir relacionados con el baloncesto y sin la necesidad de ir navegando por el complicado mundo de Internet yendo de p&aacute;gina en p&aacute;gina hasta dar con tu producto deseado.</p>

						<p class="text-monospace">Flexibilidad de acceso al servicio: desde donde quiera y cuando quiera.</p>

						<p class="text-monospace">En Basket VB dispondr&aacute;s de los siguientes <strong>PRODUCTOS:</strong></p>

						<p><strong><span style="text-decoration: underline;">Accesorios</span></strong>: anillos, calcetines, cintas y calentadores.</p>

						<p><strong><span style="text-decoration: underline;">Confecci&oacute;n</span></strong>: camisetas, camisetas manga corta, pantalones y sudaderas.</p>

						<p>Las camisetas de las que <strong>disponemos</strong> son: All-Star, Chinese Edition, City Edition, Classic, Earned Edition, Christmas Day, Latin Nights, Normal, St. Patrick' s Day, Selections, University.</p>

						<p><span style="text-decoration: underline;"><strong>Souvenirs</strong></span>: balones, bolsas, fundas, gorras, gorros, juegos, posters y tazas.</p>

						<p><span style="text-decoration: underline;"><strong>Wallpapers</strong></span>.</p>

						<p><span style="text-decoration: underline;"><strong>Calzado</strong></span>: Adidas, Jordan, Nike, Under Armour.</p>
					</div>
					<br>
					<center>
						<button type="button" class="btn btn-outline-primary">
							<a href="{{ URL::previous() }}">Volver</a>
						</button>
					</center>
				</div>
				<br>
			</div>
		</div>

		@include('layout.plantilla_script')
	</body>
	</html>