<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Cookie;
use Zipper;

class ProductosCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $productos = Producto::where('activo', 1)
        ->orderBy('id')->paginate(9);

        $equipo = $request->equipo;

        $talla = $request->get('talla');

        if ($equipo) {
            $productos = Producto::where('nombre', 'like', '%'.$equipo.'%')
            ->where('activo', 1)
            ->orderBy('nombre')
            ->paginate(9)->setPath('');

            $productos->appends(['equipo' => $equipo]);

            return response(view('productosC.index', compact('productos')))
            ->cookie('productosC_cookie', 'productosC.index', 10080);
        }

        if ($talla) {
            $productos = Producto::where('activo', 1)
            ->where('talla', $talla)
            ->orderBy('id')
            ->paginate(9)->setPath('');

            $productos->appends(['talla' => $talla]);

            return response(view('productosC.index', compact('productos')))
            ->cookie('productosC_cookie', 'productosC.index', 10080);
        }

        $this->oculto();

        return response(view('productosC.index', compact('productos')))
        ->cookie('productosC_cookie', 'productosC.index', 10080);
    }

    public function oculto() {

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

        return redirect('/productosC');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $producto = Producto::findOrFail($id);

        $dia = now()->dayOfWeek;

        if ($dia == '4') {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 0]);
        } else {
            Producto::where('tipo_producto', '!=', 17)->update(['iva' => 21]);
        }

        $hoy = date('Y-m-d');

        if ($producto) {
            $normal = $producto->pvp/(1 - ($producto->rebajado/100));

            $normalizar = Producto::where('rebaja_fin', '<=', $hoy)
            ->update(['pvp' => $normal, 'rebajado' => 0, 'rebaja_inicio' => null, 'rebaja_fin' => null]);
        }

        return view('productosC.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function comprimirDescarga(Request $request) {

        $nombre = $request->get('foto');

        $files = glob(public_path('images/'.$nombre));

        Zipper::make(public_path('app/public/'.$nombre.'.zip'))->add($files)->close();

        return response()->download(public_path('app/public/'.$nombre.'.zip'));
    }
}
