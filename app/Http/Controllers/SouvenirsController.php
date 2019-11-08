<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Zipper;
use Cookie;

class SouvenirsController extends Controller
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

        $productos = Producto::whereIn('tipo_producto', [2,3,9,10,11,12,14,16])->where('activo', 1)->orderBy('id')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->whereIn('tipo_producto', [2,3,9,10,11,12,14,16])->where('activo', 1)
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

            return response(view('souvenirs.index', compact('productos')))
            ->cookie('souvenirs_cookie', 'souvenirs.index', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->whereIn('tipo_producto', [2,3,9,10,11,12,14,16])
            ->where('talla', $talla)
            ->orderBy('id')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('souvenirs.index', compact('productos')))
            ->cookie('souvenirs_cookie', 'souvenirs.index', 10080);
        }

        $this->ocultoSouvenirs();

        return response(view('souvenirs.index', compact('productos')))
        ->cookie('souvenirs_cookie', 'souvenirs.index', 10080);
    }

    public function ocultoSouvenirs() {

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

        return redirect('/souvenirs');
    }

    public function bolsas(Request $request) {

        $equipo = $request->get('equipo');

        $productos = Producto::where('tipo_producto', 3)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '3')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('souvenirs.bolsas', compact('productos')))
            ->cookie('bolsas_cookie', 'souvenirs.bolsas', 10080);
        }

        $this->ocultoBolsas();

        return response(view('souvenirs.bolsas', compact('productos')))
        ->cookie('bolsas_cookie', 'souvenirs.bolsas', 10080);
    }

    public function ocultoBolsas() {

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

        return redirect('/bolsas');
    }

    public function fundas(Request $request) {

        $equipo = $request->get('equipo');

        $productos = Producto::where('tipo_producto', 9)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '9')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('souvenirs.fundas', compact('productos')))
            ->cookie('fundas_cookie', 'souvenirs.fundas', 10080);
        }

        $this->ocultoFundas();

        return response(view('souvenirs.fundas', compact('productos')))
        ->cookie('fundas_cookie', 'souvenirs.fundas', 10080);
    }

    public function ocultoFundas() {

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

        return redirect('/fundas');
    }

    public function gorras(Request $request) {

        $equipo = $request->get('equipo');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 11)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '11')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('souvenirs.gorras', compact('productos')))
            ->cookie('gorras_cookie', 'souvenirs.gorras', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 11)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('souvenirs.gorras', compact('productos')))
            ->cookie('gorras_cookie', 'souvenirs.gorras', 10080);
        }

        $this->ocultoGorras();

        return response(view('souvenirs.gorras', compact('productos')))
        ->cookie('gorras_cookie', 'souvenirs.gorras', 10080);
    }

    public function ocultoGorras() {

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

        return redirect('/gorras');
    }

    public function gorros(Request $request) {

        $equipo = $request->get('equipo');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 10)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '10')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('souvenirs.gorros', compact('productos')))
            ->cookie('gorros_cookie', 'souvenirs.gorros', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 10)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('souvenirs.gorros', compact('productos')))
            ->cookie('gorros_cookie', 'souvenirs.gorros', 10080);
        }

        $this->ocultoGorros();

        return response(view('souvenirs.gorros', compact('productos')))
        ->cookie('gorros_cookie', 'souvenirs.gorros', 10080);
    }

    public function ocultoGorros() {

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

        return redirect('/gorros');
    }

    public function juegos(Request $request) {

        $productos = Producto::where('tipo_producto', '=', '12')->where('activo', 1)
        ->orderBy('nombre', 'ASC')
        ->paginate(9);

        $this->ocultoJuegos();

        return response(view('souvenirs.juegos', compact('productos')))
        ->cookie('juegos_cookie', 'souvenirs.juegos', 10080);
    }

    public function ocultoJuegos() {

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

        return redirect('/juegos');
    }

    public function posters(Request $request) {

        $productos = Producto::where('tipo_producto', '=', '14')->where('activo', 1)
        ->orderBy('nombre', 'ASC')
        ->paginate(9);

        $this->ocultoPosters();

        return response(view('souvenirs.posters', compact('productos')))
        ->cookie('posters_cookie', 'souvenirs.posters', 10080);
    }

    public function ocultoPosters() {

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

        return redirect('/posters');
    }

    public function tazas(Request $request) {

        $equipo = $request->get('equipo');

        $productos = Producto::where('tipo_producto', 16)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '16')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('souvenirs.tazas', compact('productos')))
            ->cookie('tazas_cookie', 'souvenirs.tazas', 10080);
        }

        $this->ocultoTazas();

        return response(view('souvenirs.tazas', compact('productos')))
        ->cookie('tazas_cookie', 'souvenirs.tazas', 10080);
    }

    public function ocultoTazas() {

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

        return redirect('/tazas');
    }

    public function balones(Request $request) {

        $equipo = $request->get('equipo');

        $talla = $request->get('talla');

        $productos = Producto::where('tipo_producto', 2)->where('activo', 1)->orderBy('nombre')->paginate(9);

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('tipo_producto', '=', '2')->where('activo', 1)
            ->orderBy('nombre', 'ASC')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('souvenirs.balones', compact('productos')))
            ->cookie('balones_cookie', 'souvenirs.balones', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)->where('tipo_producto', 2)
            ->where('talla', $talla)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('souvenirs.balones', compact('productos')))
            ->cookie('balones_cookie', 'souvenirs.balones', 10080);
        }

        $this->ocultoBalones();

        return response(view('souvenirs.balones', compact('productos')))
        ->cookie('balones_cookie', 'souvenirs.balones', 10080);
    }

    public function ocultoBalones() {

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

        return redirect('/balones');
    }

    public function imprimirSouvenirs() {

        $productos = Producto::where('activo', 1)->whereIn('tipo_producto', [2,3,9,10,11,12,14,16])->get();

        $pdf = \PDF::loadView('pdf.pdfSouvenirs', compact('productos'));

        $pdf->setPaper('A3', 'landscape');

        return $pdf->download('Souvenirs.pdf');
    }
}
