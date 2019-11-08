<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Zipper;
use Cookie;

class CalzadoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {

    	$marca = $request->get('proveedor');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 18)->where('activo', 1)->orderBy('id')->paginate(9);

        if ($marca) {
            $productos = Producto::where('proveedor', 'like', '%'.$marca.'%')
            ->where('tipo_producto', '=', '18')->where('activo', 1)
            ->orderBy('id', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['proveedor' => $marca]);

            return response(view('calzado.index', compact('productos')))
            ->cookie('calzado_cookie', 'calzado.index', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 18)
            ->where('talla', $talla)
            ->orderBy('id')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('calzado.index', compact('productos')))
            ->cookie('calzado_cookie', 'calzado.index', 10080);
        }

        $this->ocultoCalzado();

        return response(view('calzado.index', compact('productos')))
        ->cookie('calzado_cookie', 'calzado.index', 10080);
    }

    public function ocultoCalzado() {

        $dia = now()->dayOfWeek;

        if ($dia == '4') {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 0]);
        } else {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 21]);
        }

        $hoy = date('Y-m-d');

        $productos = Producto::where('activo', 1)->where('rebajado', '!=', 0)
        ->where('rebaja_fin', '<=', $hoy)->get();

        if ($productos) {
            
            foreach ($productos as $producto) {
                
                $normal = $producto->pvp/(1 - ($producto->rebajado/100));

                $normalizar = Producto::where('rebaja_fin', '<=', $hoy)
                ->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
            }
        }

        return redirect('/calzado');
    }

    public function adidas(Request $request) {

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', '=', '18')
        ->where('proveedor', '=', 'Adidas')->where('activo', 1)
        ->orderBy('nombre', 'ASC')
        ->paginate(9);


        if ($talla) {
            $productos = Producto::where('talla', '=', $talla)
            ->where('tipo_producto', '=', '18')->where('proveedor', '=', 'Adidas')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('calzado.adidas', compact('productos')))
            ->cookie('adidas_cookie', 'calzado.adidas', 10080);
        }

        $this->ocultoAdidas();

        return response(view('calzado.adidas', compact('productos')))
        ->cookie('adidas_cookie', 'calzado.adidas', 10080);
    }

    public function ocultoAdidas() {

        $dia = now()->dayOfWeek;

        if ($dia == '4') {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 0]);
        } else {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 21]);
        }

        $hoy = date('Y-m-d');

        $productos = Producto::where('activo', 1)->where('rebajado', '!=', 0)
        ->where('rebaja_fin', '<=', $hoy)->get();

        if ($productos) {
            
            foreach ($productos as $producto) {
                
                $normal = $producto->pvp/(1 - ($producto->rebajado/100));

                $normalizar = Producto::where('rebaja_fin', '<=', $hoy)
                ->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
            }
        }

        return redirect('/adidas');
    }

    public function nike(Request $request) {

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', '=', '18')
        ->where('proveedor', '=', 'Nike')->where('activo', 1)
        ->orderBy('nombre', 'ASC')
        ->paginate(9);


        if ($talla) {
            $productos = Producto::where('talla', '=', $talla)
            ->where('tipo_producto', '=', '18')->where('proveedor', '=', 'Nike')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('calzado.nike', compact('productos')))
            ->cookie('nike_cookie', 'calzado.nike', 10080);
        }

        $this->ocultoNike();

        return response(view('calzado.nike', compact('productos')))
        ->cookie('nike_cookie', 'calzado.nike', 10080);
    }

    public function ocultoNike() {

        $dia = now()->dayOfWeek;

        if ($dia == '4') {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 0]);
        } else {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 21]);
        }

        $hoy = date('Y-m-d');

        $productos = Producto::where('activo', 1)->where('rebajado', '!=', 0)
        ->where('rebaja_fin', '<=', $hoy)->get();

        if ($productos) {
            
            foreach ($productos as $producto) {
                
                $normal = $producto->pvp/(1 - ($producto->rebajado/100));

                $normalizar = Producto::where('rebaja_fin', '<=', $hoy)
                ->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
            }
        }

        return redirect('/nike');
    }

    public function jordan(Request $request) {

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', '=', '18')
        ->where('proveedor', '=', 'Jordan')->where('activo', 1)
        ->orderBy('nombre', 'ASC')
        ->paginate(9);


        if ($talla) {
            $productos = Producto::where('talla', '=', $talla)
            ->where('tipo_producto', '=', '18')->where('proveedor', '=', 'Jordan')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('calzado.jordan', compact('productos')))
            ->cookie('jordan_cookie', 'calzado.jordan', 10080);
        }

        $this->ocultoJordan();

        return response(view('calzado.jordan', compact('productos')))
        ->cookie('jordan_cookie', 'calzado.jordan', 10080);
    }

    public function ocultoJordan() {

        $dia = now()->dayOfWeek;

        if ($dia == '4') {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 0]);
        } else {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 21]);
        }

        $hoy = date('Y-m-d');

        $productos = Producto::where('activo', 1)->where('rebajado', '!=', 0)
        ->where('rebaja_fin', '<=', $hoy)->get();

        if ($productos) {
            
            foreach ($productos as $producto) {
                
                $normal = $producto->pvp/(1 - ($producto->rebajado/100));

                $normalizar = Producto::where('rebaja_fin', '<=', $hoy)
                ->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
            }
        }

        return redirect('/jordan');
    }

    public function under(Request $request) {

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', '=', '18')
        ->where('proveedor', '=', 'Under Armour')->where('activo', 1)
        ->orderBy('nombre', 'ASC')
        ->paginate(9);


        if ($talla) {
            $productos = Producto::where('talla', '=', $talla)
            ->where('tipo_producto', '=', '18')->where('proveedor', '=', 'Under Armour')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('calzado.under', compact('productos')))
            ->cookie('under_cookie', 'calzado.under', 10080);
        }

        $this->ocultoUnder();

        return response(view('calzado.under', compact('productos')))
        ->cookie('under_cookie', 'calzado.under', 10080);
    }

    public function ocultoUnder() {

        $dia = now()->dayOfWeek;

        if ($dia == '4') {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 0]);
        } else {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 21]);
        }

        $hoy = date('Y-m-d');

        $productos = Producto::where('activo', 1)->where('rebajado', '!=', 0)
        ->where('rebaja_fin', '<=', $hoy)->get();

        if ($productos) {
            
            foreach ($productos as $producto) {
                
                $normal = $producto->pvp/(1 - ($producto->rebajado/100));

                $normalizar = Producto::where('rebaja_fin', '<=', $hoy)
                ->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
            }
        }

        return redirect('/under');
    }

    public function imprimirCalzado() {

        $productos = Producto::where('activo', 1)->where('tipo_producto', '=', '18')->paginate(9);

        $pdf = \PDF::loadView('pdf.pdfCalzado', compact('productos'));

        $pdf->setPaper('A3', 'landscape');

        return $pdf->download('Calzado.pdf');
    }
}
