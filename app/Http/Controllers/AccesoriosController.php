<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Zipper;
use Cookie;

class AccesoriosController extends Controller
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

        $productos = Producto::where('activo', 1)->whereIn('tipo_producto', [1,4,5,8])->orderBy('id')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->whereIn('tipo_producto', [1,4,5,8])->where('activo', 1)
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

            return response(view('accesorios.index', compact('productos')))
            ->cookie('accesorios_cookie', 'accesorios.index', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->whereIn('tipo_producto', [1,4,5,8])
            ->where('talla', $talla)
            ->orderBy('id')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('accesorios.index', compact('productos')))
            ->cookie('accesorios_cookie', 'accesorios.index', 10080);
        }

        $this->ocultoAccesorios();

        return response(view('accesorios.index', compact('productos')))
        ->cookie('accesorios_cookie', 'accesorios.index', 10080);
    }

    public function ocultoAccesorios() {

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

        return redirect('/accesorios');
    }

    public function anillos(Request $request) {

        $equipo = $request->get('equipo');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 1)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '1')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('accesorios.anillos', compact('productos')))
            ->cookie('anillos_cookie', 'accesorios.anillos', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 1)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('accesorios.anillos', compact('productos')))
            ->cookie('anillos_cookie', 'accesorios.anillos', 10080);
        }

        $this->ocultoAnillos();

        return response(view('accesorios.anillos', compact('productos')))
        ->cookie('anillos_cookie', 'accesorios.anillos', 10080);
    }

    public function ocultoAnillos() {

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

        return redirect('/anillos');
    }

    public function calcetines(Request $request) {

        $equipo = $request->get('equipo');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 4)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '4')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('accesorios.calcetines', compact('productos')))
            ->cookie('calcetines_cookie', 'accesorios.calcetines', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 4)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('')->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('accesorios.calcetines', compact('productos')))
            ->cookie('calcetines_cookie', 'accesorios.calcetines', 10080);
        }

        $this->ocultoCalcetines();

        return response(view('accesorios.calcetines', compact('productos')))
        ->cookie('calcetines_cookie', 'accesorios.calcetines', 10080);
    }

    public function ocultoCalcetines() {

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

        return redirect('/calcetines');
    }

    public function cintas(Request $request) {

        $marca = $request->get('proveedor');

        $productos = Producto::where('tipo_producto', 8)->where('activo', 1)->orderBy('nombre')->paginate(9);
        
        if ($marca) {
            $productos = Producto::where('proveedor', 'like', '%'.$marca.'%')
            ->where('tipo_producto', '=', '8')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['proveedor' => $marca]);

            return response(view('accesorios.cintas', compact('productos')))
            ->cookie('cintas_cookie', 'accesorios.cintas', 10080);
        }

        $this->ocultoCintas();  

        return response(view('accesorios.cintas', compact('productos')))
        ->cookie('cintas_cookie', 'accesorios.cintas', 10080);
    }

    public function ocultoCintas() {

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

        return redirect('/cintas');
    }

    public function calentadores(Request $request) {

        $marca = $request->get('proveedor');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 5)->where('activo', 1)->orderBy('nombre')->paginate(9);
        
        if ($marca) {
            $productos = Producto::where('proveedor', 'like', '%'.$marca.'%')
            ->where('tipo_producto', '=', '5')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['proveedor' => $marca]);

            return response(view('accesorios.calentadores', compact('productos')))
            ->cookie('calentadores_cookie', 'accesorios.calentadores', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 5)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('accesorios.calentadores', compact('productos')))
            ->cookie('calentadores_cookie', 'accesorios.calentadores', 10080);
        }

        $this->ocultoCalentadores();

        return response(view('accesorios.calentadores', compact('productos')))
        ->cookie('calentadores_cookie', 'accesorios.calentadores', 10080);
    }

    public function ocultoCalentadores() {

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

        return redirect('/calentadores');
    }

    public function imprimirAccesorios() {

        $productos = Producto::where('activo', 1)->whereIn('tipo_producto', [1,4,5,8])->get();

        $pdf = \PDF::loadView('pdf.pdfAccesorios', compact('productos'));

        $pdf->setPaper('A3', 'landscape');

        return $pdf->download('Accesorios.pdf');
    }
}