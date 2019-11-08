<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $fecha1 = $request->get('fecha_factura1');
        $fecha2 = $request->get('fecha_factura2');

        $facturas = \DB::table('facturas')
        ->join('pedidos', 'facturas.id', '=', 'pedidos.factura_id')
        ->join('clientes', 'facturas.user_id', '=', 'clientes.user_id')
        ->select('clientes.nombre', 'clientes.apellidos', 'facturas.pedido_id', 'facturas.total', 'facturas.fecha_factura', 'pedidos.subtotal', 'pedidos.envio', 'pedidos.metodo_pago')
        ->where('facturas.user_id', \Auth::user()->id)
        ->paginate(5);

        if ($fecha1 and $fecha2) {
            $facturas = \DB::table('facturas')
            ->join('pedidos', 'facturas.id', '=', 'pedidos.factura_id')
            ->join('clientes', 'facturas.user_id', '=', 'clientes.user_id')
            ->select('clientes.nombre', 'clientes.apellidos', 'facturas.pedido_id', 'facturas.total', 'facturas.fecha_factura', 'pedidos.subtotal', 'pedidos.envio', 'pedidos.metodo_pago')
            ->where('facturas.user_id', \Auth::user()->id)
            ->whereBetween('facturas.fecha_factura', [$fecha1, $fecha2])
            ->paginate(5)->setPath('');

            $facturas->appends(['fecha_factura1' => $fecha1, 'fecha_factura2' => $fecha2]);

            return view('facturas.index', compact('facturas'));
        }

        return view('facturas.index', compact('facturas'));
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
}
