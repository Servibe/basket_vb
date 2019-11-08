<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Cookie;
use Zipper;
use App\Mail\RebajaInicio;
use App\User;

class ProductosController extends Controller
{

    public function __construct()
    {
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

        $equipo = $request->get('equipo');
        $tipo = $request->get('tipo_producto');

        $productos = Producto::orderBy('id')->paginate(5);

        if ($equipo) {
            $productos = Producto::where('equipo', 'like', '%' .$equipo. '%')
            ->orderBy('id', 'ASC')
            ->paginate(5)->setPath('');

            if ($tipo) {
                $productos = Producto::where('tipo_producto', '=', $tipo)
                ->where('equipo', 'like', '%' .$equipo. '%')
                ->orderBy('id', 'ASC')
                ->paginate(5)->setPath('');
            }

            $productos->appends(['equipo' => $equipo, 'tipo_producto' => $tipo]);

            return view('productos.index', compact('productos'));
        }

        return view('productos.index', compact('productos'));
    }

    public function productosA(Request $request) {

        $equipo = $request->get('equipo');
        $tipo = $request->get('tipo_producto');

        $productos = Producto::where('activo', 1)->orderBy('id')->paginate(5);

        if ($equipo) {
            $productos = Producto::where('equipo', 'like', '%'.$equipo.'%')
            ->where('activo', 1)->orderBy('id')->paginate(5)->setPath('');

            if ($tipo) {
                $productos = Producto::where('tipo_producto', '=', $tipo)
                ->where('equipo', 'like', '%'.$equipo.'%')->where('activo', 1)
                ->orderBy('id')->paginate(5)->setPath('');
            }

            $productos->appends(['equipo' => $equipo, 'tipo_producto' => $tipo]);

            return view('productos.indexA', compact('productos'));
        }

        return view('productos.indexA', compact('productos'));
    }

    public function productosR(Request $request) {

        $fecha = $request->get('rebaja_fin');

        $productos = Producto::where('activo', 1)->where('rebajado', '!=', 0)
        ->orderBy('rebaja_fin')->paginate(5);

        if ($fecha) {
            
            $productos = Producto::where('activo', 1)->where('rebajado', '!=', 0)
            ->where('rebaja_fin', $fecha)->orderBy('rebaja_fin')->paginate(5)->setPath('');

            $productos->appends(['rebaja_fin' => $fecha]);

            return view('productos.rebajados', compact('productos'));
        }

        return view('productos.rebajados', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('productos.create');
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
        $this->validate($request, ['nombre'=>'required', 'tipo_producto'=>'required', 'stock_actual'=>'required', 'stock_maximo'=>'required', 'stock_minimo'=>'required', 'foto'=>'required']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
        }

        $producto = new Producto();

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        if ($request->tipo_producto == 8 || $request->tipo_producto == 3 || $request->tipo_producto == 14 
            || $request->tipo_producto == 16 || $request->tipo_producto == 12 || $request->tipo_producto == 9 || $request->tipo_producto == 17) {

            $producto->talla = null;
        } else {
            $producto->talla = $request->talla;
        }
        $producto->equipo = $request->equipo;
        $producto->tipo_producto = $request->tipo_producto;
        $producto->proveedor = $request->proveedor;
        if (($request->tipo_producto) == 17) {
            $producto->iva = 0;
        } else {
            $producto->iva = $request->iva;
        }
        if (($producto->tipo_producto) != 17) {
            $precio_iva = $request->precio_compra + ($request->precio_compra * ($request->iva/100));
            $producto->precio_compra = $precio_iva;
        } else {
            $producto->precio_compra = 0;
        }
        if (($producto->tipo_producto) == 17) {
            $producto->pvp = 0;
        } else {
            $producto->pvp = $request->pvp;
        }
        $producto->codigo_barras = $this->generarCodigo();
        $producto->stock_actual = $request->stock_actual;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->foto = $name;
        $producto->activo = $request->activo;
        $producto->rebajado = $request->rebajado;
        $producto->rebaja_inicio = $request->rebaja_inicio;
        $producto->rebaja_fin = $request->rebaja_fin;

        if($producto->save()) {
            return redirect('/productos');
        } else {
            return redirect('/productos')->with('alert', 'El producto ya existe');
        }
    }

    private function generarCodigo($lenght = 8) {

        $fecha_actual = date('Ymd');

        $caracteres = '0123456789';

        $caracteresLenght = strlen($caracteres);

        $randomString = '';

        for ($i=0; $i < $lenght; $i++) { 
            $randomString .= $caracteres[rand(0, $caracteresLenght - 1)];
        }

        return $fecha_actual.$randomString;
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
        $producto = Producto::findOrFail($id);

        return view('productos.edit', compact('producto'));
    }

    public function precio($id) {
        $producto = Producto::findOrFail($id);

        return view('productos.precio', compact('producto'));
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

        $producto = Producto::findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
        }

        $producto->nombre= $request->nombre;
        $producto->descripcion = $request->descripcion;
        if ($request->tipo_producto == 8 || $request->tipo_producto == 3 || $request->tipo_producto == 14 
            || $request->tipo_producto == 16 || $request->tipo_producto == 12 || $request->tipo_producto == 9 || $request->tipo_producto == 17) {

            $producto->talla = null;
        } else {
            $producto->talla = $request->talla;
        }
        $producto->equipo = $request->equipo;
        $producto->tipo_producto = $request->tipo_producto;
        $producto->proveedor = $request->proveedor;
        if (($producto->tipo_producto) != 17) {
            $precio_iva = $request->precio_compra + ($request->precio_compra * ($request->iva/100));
            $producto->precio_compra = $precio_iva;
        } else {
            $producto->precio_compra = 0;
        }
        if (($producto->tipo_producto) == 17) {
            $producto->pvp = 0;
        } else {
            $producto->pvp = $request->pvp;
        }
        $producto->codigo_barras = $this->generarCodigo();
        $producto->stock_actual = $request->stock_actual;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->stock_minimo = $request->stock_minimo;
        if ($request->hasFile('foto')) {
            $producto->foto = $name;
        }
        $producto->activo = $request->activo;
        $producto->rebajado = $request->rebajado;
        $producto->rebaja_inicio = $request->rebaja_inicio;
        $producto->rebaja_fin = $request->rebaja_fin;

        if($producto->save()) {
            return redirect('/productos');
        } else {
            echo "No se ha actualizado ningún producto";
        }
    }

    public function precios(Request $request, $id) {

        $producto = Producto::findOrFail($id);

        $precio_iva = $request->precio_compra + ($request->precio_compra/$request->iva);
        $producto->precio_compra = $precio_iva;
        $producto->pvp = $request->pvp;

        if ($producto->save()) {
            return redirect('/productos');
        }
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

    public function imprimirProductos() {

        $productos = Producto::all();

        $pdf = \PDF::loadView('pdf.pdfProductos', compact('productos'));

        $pdf->setPaper('A2', 'landscape');

        return $pdf->download('Productos.pdf');
    }

    public function imprimirProductosA() {

        $productos = Producto::where('activo', 1)->get();

        $pdf = \PDF::loadView('pdf.pdfProductosA', compact('productos'));

        $pdf->setPaper('A2', 'landscape');

        return $pdf->download('ProductosA.pdf');
    }

    public function rebajas(Request $request, $id) {

        $producto = Producto::findOrFail($id);

        $producto->rebajado = $request->rebajado;

        $producto->rebaja_inicio = now()->toDateString();

        $producto->rebaja_fin = now()->addDays($request->tiempo)->toDateString();

        if ($producto->save()) {

            $rebaja_pvp = $producto->pvp - (($producto->rebajado * $producto->pvp) / 100);
            
            $rebajar = Producto::where('id', $id)
            ->update([
                'pvp' => $rebaja_pvp, 
                'rebajado' => $producto->rebajado, 
                'rebaja_inicio' => $producto->rebaja_inicio,
                'rebaja_fin' => $producto->rebaja_fin
            ]);

            if ($rebajar) {

                $correos = User::join('clientes', 'users.id', '=', 'clientes.user_id')->select('users.email')->where('users.activo', 1)->where('clientes.recibir_ofertas', 1)->get();
                \Mail::bcc($correos)->send(new RebajaInicio);

                \Flash::success('Se ha rebajado el producto ' . $producto->nombre);

                return redirect('/productosR');
            }
        }
    }

    public function normal($id) {

        $producto = Producto::findOrFail($id);

        if ($producto) {

            $normal_pvp = $producto->pvp/(1 - ($producto->rebajado/100));

            $normalizar = Producto::where('id', $id)
            ->update([
                'pvp' => $normal_pvp, 
                'rebajado' => 0,
                'rebaja_inicio' => null,
                'rebaja_fin' => null
            ]);

            if ($normalizar) {

                \Flash::success('El producto ' . $producto->nombre . ' ya no tiene descuento.');

                return redirect('/productosR');
            }  
        }
    }
}