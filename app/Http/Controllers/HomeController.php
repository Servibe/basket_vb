<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use App\Producto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $this->ocultoHome();
        
        return response(view('home'))
        ->cookie('home_cookies', 'home', 10080);
    }

    public function ocultoHome() {

        $dia = now()->dayOfWeek;

        if ($dia == '4') {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 0]);
        } else {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 21]);
        }

        $hoy = date('Y-m-d');

        $productos = Producto::where('activo', 1)->where('rebajado', '!=', 0)->where('rebaja_fin', '<=', $hoy)->get();

        if ($productos) {
            foreach ($productos as $producto) {
                $normal = $producto->pvp/(1 - ($producto->rebajado/100));

                $normalizar = Producto::where('rebaja_fin', '<=', $hoy)
                ->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
            }
        }
    }
}
