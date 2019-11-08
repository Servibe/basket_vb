<?php
use App\Mail\Bienvenida;
use App\Http\Controllers\HomeController;

/* -------------------- RUTAS GENERALES -----------------------------------------*/

Route::get('/', function () {
	error_reporting(0);

	$ocultoWelcome = new HomeController();

	$ocultar = $ocultoWelcome->ocultoHome();

	$productos = App\Producto::where('activo', 1)->where('rebajado', '!=', 0)->get();

	$dia = now()->dayOfWeek;

	if ($dia == '4') {
		App\Producto::where('tipo_producto', '!=', 17)->update(['iva' => 0]);
	} else {
		App\Producto::where('tipo_producto', '!=', 17)->update(['iva' => 21]);
	}

	$hoy = date('Y-m-d');

	if (isset($productos)) {
		while ($productos == true) {

			$producto_rebaja = App\Producto::where('activo', 1)->whereNotNull('rebaja_fin')
			->where('rebaja_fin', '<=', $hoy)->get(['rebaja_fin']);

			if ($producto_rebaja != null) {

				$normal = $productos[0]->pvp/(1 - ($productos[0]->rebajado/100));

				$recuperar = App\Producto::where('rebaja_fin', '<=', $hoy)->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
			} 

			break;
		}
	}

	return view('welcome', compact('productos'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/clientes', 'ClientesController');

Route::get('/activos', 'ClientesController@activo');

Route::resource('/productos', 'ProductosController');

Route::get('/productosA', 'ProductosController@productosA');

Route::get('/producto/precio/{id}', 'ProductosController@precio');

Route::post('/producto/precios/{id}', 'ProductosController@precios');

Route::post('/producto/rebajas/{id}', 'ProductosController@rebajas');

Route::post('/producto/normal/{id}', 'ProductosController@normal');

Route::get('/productosR', 'ProductosController@productosR');

Route::resource('/productosC', 'ProductosCController');

Route::resource('/pedidos', 'PedidosController');

Route::get('/mis_pedidos', 'PedidosController@indexC');

Route::resource('/usuarios', 'UsuariosController');

Route::get('/usuario/password', 'UsuariosController@password');

Route::post('/usuario/updatepassword', 'UsuariosController@updatePassword');

Route::get('/usuario/cambiar', 'UsuariosController@cambiar');

Route::post('/usuario/actualizar', 'UsuariosController@actualizar');

Route::post('/usuario/recuperar', 'UsuariosController@recuperar');

Route::post('/usuario/eliminar/{id}', 'UsuariosController@eliminar');

Route::resource('/stock', 'StockController');

Route::resource('/facturas', 'FacturasController');

Route::resource('/proveedores', 'ProveedoresController');

Route::get('/proveedoresA', 'ProveedoresController@proveedoresA');

Route::get('/cart/show', 'CartController@show')->name('cart-show');

Route::get('/cart/add/{producto}', 'CartController@add')->name('cart-add');

Route::get('/cart/trash', 'CartController@trash')->name('cart-trash');

Route::get('/cart/update/{producto}/{stock_actual?}', 'CartController@update')->name('cart-update');

Route::get('/cart/delete/{producto}', 'CartController@delete')->name('cart-delete');

Route::get('/order-detail', 'CartController@orderDetail')->name('order-detail');

Route::get('/payment', 'PaypalController@postPayment')->name('payment');

Route::get('/payment/status', 'PaypalController@getPaymentStatus')->name('payment.status');

Route::resource('/accesorios', 'AccesoriosController');

Route::get('/anillos', 'AccesoriosController@anillos');

Route::get('/calcetines', 'AccesoriosController@calcetines');

Route::get('/cintas', 'AccesoriosController@cintas');

Route::get('/calentadores', 'AccesoriosController@calentadores');

Route::resource('/confeccion', 'ConfeccionController');

Route::get('/camisetas', 'ConfeccionController@camisetas');

Route::get('/mangas', 'ConfeccionController@mangas');

Route::get('/pantalones', 'ConfeccionController@pantalones');

Route::get('/sudaderas', 'ConfeccionController@sudaderas');

Route::resource('/souvenirs', 'SouvenirsController');

Route::get('/bolsas', 'SouvenirsController@bolsas');

Route::get('/fundas', 'SouvenirsController@fundas');

Route::get('/gorras', 'SouvenirsController@gorras');

Route::get('/gorros', 'SouvenirsController@gorros');

Route::get('/juegos', 'SouvenirsController@juegos');

Route::get('/posters', 'SouvenirsController@posters');

Route::get('/tazas', 'SouvenirsController@tazas');

Route::get('/balones', 'SouvenirsController@balones');

Route::resource('/wallpapers', 'WallpapersController');

Route::get('/ordenador', 'WallpapersController@ordenador');

Route::get('/movil', 'WallpapersController@movil');

Route::resource('/calzado', 'CalzadoController');

Route::get('/adidas', 'CalzadoController@adidas');

Route::get('/nike', 'CalzadoController@nike');

Route::get('/jordan', 'CalzadoController@jordan');

Route::get('/under', 'CalzadoController@under');

/* ------------------------------------------------------------------------------- */

/* ---------------------------- RUTAS IMPRIMIR --------------------------*/

Route::name('imprimirProductos')->get('/imiprimirProductos', 'ProductosController@imprimirProductos');

Route::name('imprimirProductosA')->get('/imprimirProductosA', 'ProductosController@imprimirProductosA');

Route::name('imprimirAccesorios')->get('/imprimirAccesorios', 'AccesoriosController@imprimirAccesorios');

Route::name('imprimirConfeccion')->get('/imprimirConfeccion', 'ConfeccionController@imprimirConfeccion');

Route::name('imprimirSouvenirs')->get('/imprimirSouvenirs', 'SouvenirsController@imprimirSouvenirs');

Route::name('imprimirWallpapers')->get('/imprimirWallpapers', 'WallpapersController@imprimirWallpapers');

Route::name('imprimirCalzado')->get('/imprimirCalzado', 'CalzadoController@imprimirCalzado');

Route::name('imprimirPedidos')->get('/imprimirPedidos', 'PedidosController@imprimirPedidos');

Route::name('imprimirFacturas')->get('/imprimirFacturas', 'FacturasController@imprimirFacturas');

Route::name('imprimirProveedores')->get('/imprimirProveedores', 'ProveedoresController@imprimirProveedores');

Route::name('imprimirProveedoresA')->get('/imprimirProveedoresA', 'ProveedoresController@imprimirProveedoresA');

Route::name('imprimirClientes')->get('/imprimirClientes', 'ClientesController@imprimirClientes');

Route::name('imprimirClientesA')->get('/imprimirClientesA', 'ClientesController@imprimirActivos');

Route::name('imprimirFactura')->get('/impirimirFactura/{id}', 'PedidosController@imprimirFactura');

Route::name('verFactura')->get('/verFactura/{id}', 'PedidosController@verFactura');

/* --------------------------------------------------------------------------- */

/* --------------------------------- RUTAS DESCARGAS ------------------------------------ */ 

Route::get('/comprimir', 'ProductosCController@comprimirDescarga')->name('comprimir');

Route::get('/comprimirW', 'WallpapersController@comprimirDescarga')->name('comprimirWallpapers');

/* ------------------------------------------------------------------------------- */

/* -------------------------- RUTAS MAILS Y FOOTER ----------------------------- */

Route::get('contact-us', 'ContactUSController@contactUS')->name('/contact-us');

Route::post('/contact-us', ['as' => 'contactus.store', 'uses' => 'ContactUSController@contactUSPost']);

Route::resource('/comentarios', 'ComentariosController');

Route::get('/enviar', function() {
	$correo = Auth::user()->email;
	Mail::to($correo)->send(new Bienvenida);
	return redirect('/home');
});

Route::get('/nosotros', function () {
	return view('nosotros');
})->name('/nosotros');

Route::get('/cookies', function() {
	return view('cookies');
});

Route::get('/terminos', function() {
	return view('terminos');
})->name('/terminos');

Route::get('/privacidad', function() {
	return view('privacidad');
})->name('/privacidad');

/* ------------------------------------------------------- */

Cache::put('key', 'value', now()->addSeconds(120));

/* -------------------------- RUTAS EXCEL --------------------------- */

Route::get('/exportar', 'ClientesController@exportar');

Route::get('/exportarA', 'ClientesController@exportarA');

Route::get('/exportarPedidos', 'PedidosController@exportar');

/* ------------------------------------------------------------------------ */

/* --------------------------- RUTAS OCULTAS ------------------------------------- */

Route::get('/oculto', 'ProductosCController@oculto');

Route::get('/ocultoAccesorios', 'AccesoriosController@ocultoAccesorios');

Route::get('/ocultoAnillos', 'AccesoriosController@ocultoAnillos');

Route::get('/ocultoCalcetines', 'AccesoriosController@ocultoCalcetines');

Route::get('/ocultoCintas', 'AccesoriosController@ocultoCintas');

Route::get('/ocultoCalentadores', 'AccesoriosController@ocultoCalentadores');

Route::get('/ocultoCalzado', 'CalzadoController@ocultoCalzado');

Route::get('/ocultoNike', 'CalzadoController@ocultoNike');

Route::get('/ocultoAdidas', 'CalzadoController@ocultoAdidas');

Route::get('/ocultoJordan', 'CalzadoController@ocultoJordan');

Route::get('/ocultoUnder', 'CalzadoController@ocultoUnder');

Route::get('/ocultoSouvenirs', 'SouvenirsController@ocultoSouvenirs');

Route::get('/ocultoBalones', 'SouvenirsController@ocultoBalones');

Route::get('/ocultoBolsas', 'SouvenirsController@ocultoBolsas');

Route::get('/ocultoFundas', 'SouvenirsController@ocultoFundas');

Route::get('/ocultoGorras', 'SouvenirsController@ocultoGorras');

Route::get('/ocultoGorros', 'SouvenirsController@ocultoGorros');

Route::get('/ocultoJuegos', 'SouvenirsController@ocultoJuegos');

Route::get('/ocultoPosters', 'SouvenirsController@ocultoPosters');

Route::get('/ocultoTazas', 'SouvenirsController@ocultoTazas');

Route::get('/ocultoConfeccion', 'ConfeccionController@ocultoConfeccion');

Route::get('/ocultoCamisetas', 'ConfeccionController@ocultoCamisetas');

Route::get('/ocultoMangas', 'ConfeccionController@ocultoMangas');

Route::get('/ocultoSudaderas', 'ConfeccionController@ocultoSudaderas');

Route::get('/ocultoPantalones', 'ConfeccionController@ocultoPantalones');

Route::get('/ocultoVolver', function() {

	$productos = App\Producto::where('activo', 1)->where('rebajado', '!=', 0)->get();

	$hoy = date('Y-m-d');

	if ($productos) {
		foreach ($productos as $producto) {
			$normal = $producto->pvp/(1 - ($producto->rebajado/100));

			$normalizar = App\Producto::where('rebaja_fin', '<=', $hoy)->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
		}
	}

	return redirect()->intended('/productosC');
});

Route::get('/ocultoVolverAccesorios', function() {

	$productos = App\Producto::where('activo', 1)->where('rebajado', '!=', 0)->get();

	$hoy = date('Y-m-d');

	if ($productos) {
		foreach ($productos as $producto) {
			$normal = $producto->pvp/(1 - ($producto->rebajado/100));

			$normalizar = App\Producto::where('rebaja_fin', '<=', $hoy)->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
		}
	}

	return redirect()->intended('/accesorios');
});

Route::get('/ocultoVolverCalazado', function() {

	$productos = App\Producto::where('activo', 1)->where('rebajado', '!=', 0)->get();

	$hoy = date('Y-m-d');

	if ($productos) {
		foreach ($productos as $producto) {
			$normal = $producto->pvp/(1 - ($producto->rebajado/100));

			$normalizar = App\Producto::where('rebaja_fin', '<=', $hoy)->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
		}
	}

	return redirect()->intended('/calzado');
});

Route::get('/ocultoVolverConfeccion', function() {

	$productos = App\Producto::where('activo', 1)->where('rebajado', '!=', 0)->get();

	$hoy = date('Y-m-d');

	if ($productos) {
		foreach ($productos as $producto) {
			$normal = $producto->pvp/(1 - ($producto->rebajado/100));

			$normalizar = App\Producto::where('rebaja_fin', '<=', $hoy)->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
		}
	}

	return redirect()->intended('/confeccion');
});

Route::get('/ocultoVolverSouvenirs', function() {

	$productos = App\Producto::where('activo', 1)->where('rebajado', '!=', 0)->get();

	$hoy = date('Y-m-d');

	if ($productos) {
		foreach ($productos as $producto) {
			$normal = $producto->pvp/(1 - ($producto->rebajado/100));

			$normalizar = App\Producto::where('rebaja_fin', '<=', $hoy)->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
		}
	}

	return redirect()->intended('/souvenirs');
});

/* ------------------------------------------------------------------------------------- */