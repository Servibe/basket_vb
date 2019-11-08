<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Zipper;
use Cookie;

class ConfeccionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {

    	$equipo = $request->get('equipo');

        $tipos = $request->get('tipos');

        $talla = $request->get('talla');

        $productos = Producto::whereIn('tipo_producto', [6,7,13,15])->where('activo', 1)->orderBy('id')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->whereIn('tipo_producto', [6,7,13,15])->where('activo', 1)
            ->orderBy('id', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            if($tipos) {
                $productos = Producto::where('tipo_producto', $tipos)
                ->where('equipo', 'like', '%'.$equipo.'%')
                ->orderBy('id')->paginate(9)->setPath('');

                $productos->appends(['equipo' => $equipo, 'tipos' => $tipos]);

                return view('souvenirs.index', compact('productos'));
            }

            return response(view('confeccion.index', compact('productos')))
            ->cookie('confeccion_cookie', 'confeccion.index', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->whereIn('tipo_producto', [6,7,13,15])
            ->where('talla', $talla)
            ->orderBy('id')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('confeccion.index', compact('productos')))
            ->cookie('confeccion_cookie', 'confeccion.index', 10080);
        }

        $this->ocultoConfeccion();

        return response(view('confeccion.index', compact('productos')))
        ->cookie('confeccion_cookie', 'confeccion.index', 10080);
    }

    public function ocultoConfeccion() {

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

        return redirect('/confeccion');
    }

    public function camisetas(Request $request) {

        $equipo = $request->get('equipo');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 6)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '6')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('confeccion.camisetas', compact('productos')))
            ->cookie('camisetas_cookie', 'confeccion.camisetas', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 6)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('confeccion.camisetas', compact('productos')))
            ->cookie('camisetas_cookie', 'confeccion.camisetas', 10080);
        }

        $this->ocultoCamisetas();

        return response(view('confeccion.camisetas', compact('productos')))
        ->cookie('camisetas_cookie', 'confeccion.camisetas', 10080);
    }

    public function ocultoCamisetas() {

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

        return redirect('/camisetas');
    }

    public function mangas(Request $request) {

        $equipo = $request->get('equipo');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 7)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '7')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('confeccion.mangas', compact('productos')))
            ->cookie('mangas_cookie', 'confeccion.mangas', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 7)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('confeccion.mangas', compact('productos')))
            ->cookie('mangas_cookie', 'confeccion.mangas', 10080);
        }

        $this->ocultoMangas();

        return response(view('confeccion.mangas', compact('productos')))
        ->cookie('mangas_cookie', 'confeccion.mangas', 10080);
    }

    public function ocultoMangas() {

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

        return redirect('/mangas');
    }

    public function pantalones(Request $request) {

        $equipo = $request->get('equipo');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 13)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '13')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('confeccion.pantalones', compact('productos')))
            ->cookie('pantalones_cookie', 'confeccion.pantalones', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 13)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('confeccion.pantalones', compact('productos')))
            ->cookie('pantalones_cookie', 'confeccion.pantalones', 10080);
        }

        $this->ocultoPantalones();

        return response(view('confeccion.pantalones', compact('productos')))
        ->cookie('pantalones_cookie', 'confeccion.pantalones', 10080);
    }

    public function ocultoPantalones() {

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

        return redirect('/pantalones');
    }

    public function sudaderas(Request $request) {

        $equipo = $request->get('equipo');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 15)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '15')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('confeccion.sudaderas', compact('productos')))
            ->cookie('sudaderas_cookie', 'confeccion.sudaderas', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 15)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('confeccion.sudaderas', compact('productos')))
            ->cookie('sudaderas_cookie', 'confeccion.sudaderas', 10080);
        }

        $this->ocultoSudaderas();

        return response(view('confeccion.sudaderas', compact('productos')))
        ->cookie('sudaderas_cookie', 'confeccion.sudaderas', 10080);
    }

    public function ocultoSudaderas() {

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

        return redirect('/sudaderas');
    }

    public function imprimirConfeccion() {

        $productos = Producto::where('activo', 1)->whereIn('tipo_producto', [6,7,13,15])->get();

        $pdf = \PDF::loadView('pdf.pdfConfeccion', compact('productos'));

        $pdf->setPaper('A2', 'landscape');

        return $pdf->download('Confeccion.pdf');
    }
}
