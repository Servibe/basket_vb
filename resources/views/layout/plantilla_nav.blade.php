@if(Auth::check())
@if(Auth::user()->hasRole('Admin'))
<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li class="active"><a href="/home">Home</a></li>
				<li>
					<a href="/clientes">
						Clientes
					</a>
				</li>
				@if(Auth::check())
				<li>
					<a href="/productos">
						Productos
					</a>
				</li>
				<li>
					<a href="/pedidos">Pedidos</a>
				</li>
				<li>
					<a href="/proveedores">
						Proveedores
					</a>
				</li>
				@endif
			</ul>
			<!-- /NAV -->
		</div>
		<!-- /responsive-nav -->
	</div>
	<!-- /container -->
</nav>
<!-- /NAVIGATION -->
@else
<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li class="active"><a href="/home">Home</a></li>
				<li><a href="/oculto">Productos</a></li>
				@if(Auth::check())
				<li>
					<a href="/ocultoAccesorios">
						Accesorios
					</a>
				</li>
				<li>
					<a href="/ocultoConfeccion">
						Confección
					</a>
				</li>
				<li>
					<a href="/ocultoSouvenirs">
						Souvenirs
					</a>
				</li>
				<li>
					<a href="/wallpapers">
						Wallpapers
					</a>
				</li>
				<li>
					<a href="/ocultoCalzado" >
						Calzado
					</a>
				</li>
				@endif
			</ul>
			<!-- /NAV -->
		</div>
		<!-- /responsive-nav -->
	</div>
	<!-- /container -->
</nav>
<!-- /NAVIGATION -->
@endif
@else
<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				@if(Auth::check())
				<li class="active"><a href="/home">Home</a></li>
				@else
				<li class="active"><a href="/">Home</a></li>
				@endif
				<li><a href="/oculto">Productos</a></li>
				@if(Auth::check())
				<li>
					<a href="/ocultoAccesorios">
						Accesorios
					</a>
				</li>
				<li>
					<a href="/ocultoConfeccion">
						Confección
					</a>
				</li>
				<li>
					<a href="/ocultoSouvenirs">
						Souvenirs
					</a>
				</li>
				<li>
					<a href="/wallpapers">
						Wallpapers
					</a>
				</li>
				<li>
					<a href="/ocultoCalzado" >
						Calzado
					</a>
				</li>
				@endif
			</ul>
			<!-- /NAV -->
		</div>
		<!-- /responsive-nav -->
	</div>
	<!-- /container -->
</nav>
<!-- /NAVIGATION -->
@endif