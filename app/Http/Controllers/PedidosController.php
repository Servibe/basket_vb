<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use Cookie;
use Auth;
use App\PedidoItem;
use App\Factura;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PedidosExport;

class PedidosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pedidos = Pedido::orderBy('id')->paginate(5);

        $fecha1 = $request->get('fecha_pedido');
        $fecha2 = $request->get('fecha_pedido2');

        if ($fecha1 and $fecha2) {
            $pedidos = Pedido::whereBetween('fecha_pedido', [$fecha1, $fecha2])
            ->orderBy('id')
            ->paginate(5)->setPath('');

            $pedidos->appends(['fecha_pedido' => $fecha1, 'fecha_pedido2' => $fecha2]);

            return view('pedidos.pedidos.index', compact('pedidos'));
        }

        return view('pedidos.pedidos.index', compact('pedidos'));
    }

    public function indexC(Request $request) {

        $fecha = $request->get('fecha_pedido');
        $fecha2 = $request->get('fecha_pedido2');

        $pedidos = Pedido::where('user_id', Auth::user()->id)
        ->orderBy('id')
        ->paginate(5);

        if ($fecha and $fecha2) {
            $pedidos = Pedido::where('user_id', Auth::user()->id)
            ->whereBetween('fecha_pedido', [$fecha, $fecha2])
            ->orderBy('id')
            ->paginate(5)->setPath('');

            $pedidos->appends(['fecha_pedido' => $fecha, 'fecha_pedido2' => $fecha2]);

            return view('pedidos.pedidos.indexC', compact('pedidos'));
        }

        return response(view('pedidos.pedidos.indexC', compact('pedidos')))
        ->cookie('pedidosC_cookie', 'pedido.index', 10080);
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
        $pedido = Pedido::findOrFail($id);

        return view('pedidos.show', compact('pedido'));
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

    public function imprimirPedidos() {

        $pedidos = Pedido::all();

        $pdf = \PDF::loadView('pdf.pdfPedidos', compact('pedidos'));

        $pdf->setPaper('A3', 'landscape');

        return $pdf->download('Pedidos.pdf');
    }

    public function imprimirFactura($id) {

        $factura1 = Pedido::findOrFail($id);

        $total = Pedido::select('subtotal')->where('id', $id)->first()->subtotal;

        $facturacion = Factura::create([
            'user_id' => Auth::user()->id,
            'pedido_id' => $id,
            'total' => $total,
            'fecha_factura' => now()->toDateString(),
            ]);

        if ($facturacion) {

            $id_factura = Factura::select('id')->orderBy('id', 'DESC')->take(1)->first()->id;

            $update = Pedido::where('id', $id)->update(['factura_id' => $id_factura]);
            
            $factura2 = \DB::table('pedidos')
            ->join('pedido_items', 'pedidos.id', '=', 'pedido_items.pedido_id')
            ->join('productos', 'pedido_items.producto_id', '=', 'productos.id')
            ->join('facturas', 'pedidos.factura_id', '=', 'facturas.id')
            ->select('pedidos.*', 'pedido_items.*', 'productos.*', 'facturas.*')
            ->where('pedidos.id', $id)->get();

            $pdf = \PDF::loadView('pdf.pdfFactura', compact('factura1', 'factura2'));

            $pedido_id = Pedido::select('id')->where('id', $id)->first()->id;

            if ($pdf) {

                \Flash::info('Tu Factura del Pedido ' . $pedido_id . ' ya ha sido generada. Si no se ha abierto, pulse el check para verla y descargarla.');
                
                return $pdf->download('Factura de Pedido Nº ' . $pedido_id . '.pdf');
            }
        }
    }

    public function verFactura($id) {

        $factura1 = Pedido::findOrFail($id);

        $factura2 = \DB::table('pedidos')
        ->join('pedido_items', 'pedidos.id', '=', 'pedido_items.pedido_id')
        ->join('productos', 'pedido_items.producto_id', '=', 'productos.id')
        ->join('facturas', 'pedidos.factura_id', '=', 'facturas.id')
        ->select('pedidos.*', 'pedido_items.*', 'productos.*', 'facturas.*')
        ->where('pedidos.id', $id)
        ->get();

        $pdf = \PDF::loadView('pdf.pdfVerFactura', compact('factura1', 'factura2'));

        $pedido_id = Pedido::select('id')->where('id', $id)->first()->id;

        if ($pdf) {

            return $pdf->stream('Factura de Pedido Nº ' . $pedido_id);
        }
    }

    public function exportar(Request $request) {

        $fecha1 = $request->get('fecha1');
        $fecha2 = $request->get('fecha2');

        if (isset($_GET['fechas'])) {
            if (!($fecha1 && $fecha2)) {
                \Flash::error('No hay pedidos entre las fechas introducidas.');
                return redirect('/pedidos');
            } else {
                $verificacion = Pedido::select('fecha_pedido')->whereBetween('fecha_pedido', [$fecha1, $fecha2])->count();

                if ($verificacion == 0) {
                    \Flash::error('No hay pedidos entre las fechas introducidas.');
                    return redirect('/pedidos');
                }

                return Excel::download(new PedidosExport, 'Pedidos ' . $fecha1 . ' - ' . $fecha2 . '.xls');
            }
            return Excel::download(new PedidosExport, 'Pedidos ' . $fecha1 . ' - ' . $fecha2 . '.xls');
        } else if (isset($_GET['todos'])) {
            return Excel::download(new PedidosExport, 'Pedidos.xls');
        }
    }
}