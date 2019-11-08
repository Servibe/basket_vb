<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use Cookie;

class ProveedoresController extends Controller
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

        $nombre = $request->get('nombre');

        $proveedores = Proveedor::orderBy('id')->paginate(5);

        if ($nombre) {
            $proveedores = Proveedor::where('nombre', 'like', '%' .$nombre. '%')
                ->orderBy('id', 'ASC')->paginate(5);

            return view('proveedores.index', compact('proveedores'));
        }

        return view('proveedores.index', compact('proveedores'));
    }

    public function proveedoresA(Request $request) {

        $nombre = $request->get('nombre');

        $proveedores = Proveedor::where('activo', 1)->orderBy('id')->paginate(5);

        if ($nombre) {
            $proveedores = Proveedor::where('activo', 1)
            ->where('nombre', 'like', '%' .$nombre. '%')->orderBy('id')->paginate(5);

            return view('proveedores.indexA', compact('proveedores'));
        }

        return view('proveedores.indexA', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('proveedores.create');
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

        $this->validate($request, ['nombre'=>'required', 'correo'=>'required', 'telefono'=>'required', 'cod_postal'=>'required']);

        $proveedor = new Proveedor();

        $proveedor->nombre = $request->nombre;
        $proveedor->correo = $request->correo;
        $proveedor->telefono = $request->telefono;
        $proveedor->localidad = $request->localidad;
        $proveedor->provincia = $request->provincia;
        $proveedor->calle = $request->calle;
        $proveedor->pais = $request->pais;
        $proveedor->cod_postal = $request->cod_postal;
        $proveedor->activo = $request->activo;

        if ($proveedor->save()) {
            return redirect('/proveedores');
        } else {
            echo "No se ha registrado proveedor";
        }
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

        $proveedor = Proveedor::findOrFail($id);

        return view('proveedores.edit', compact('proveedor'));
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

        $proveedor = Proveedor::findOrFail($id);

        $proveedor->update($request->all());

        return redirect('/proveedores');
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

    public function imprimirProveedores() {

        $proveedores = Proveedor::all();

        $pdf = \PDF::loadView('pdf.pdfProveedores', compact('proveedores'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Proveedores.pdf');
    }

    public function imprimirProveedoresA() {

        $proveedores = Proveedor::where('activo', 1)->get();

        $pdf = \PDF::loadView('pdf.pdfProveedoresA', compact('proveedores'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('ProveedoresA.pdf');
    }
}
