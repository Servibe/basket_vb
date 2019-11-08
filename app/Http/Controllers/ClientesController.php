<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Cookie;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\UsersAExport;

class ClientesController extends Controller
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
        $cliente = $request->get('apellidos');

        $clientes = Cliente::where('id', '!=', 1)->orderBy('id', 'ASC')
            ->paginate(5);

        if ($cliente) {
            $clientes = Cliente::where('id', '!=', 1)->where('apellidos', 'like', '%'.$cliente.'%')
                ->orderBy('id')->paginate(5)->setPath('');

            $clientes->appends(['apellidos' => $cliente]);

            return view('clientes.index', compact('clientes'));
        }

        return view('clientes.index', compact('clientes'));
    }

    public function activo(Request $request) {

        $cliente = $request->get('apellidos');

        $activos = Cliente::where('id', '!=', 1)->where('activo', 1)->orderBy('id', 'ASC')
            ->paginate(5);

        if ($cliente) {
            $activos = Cliente::where('apellidos', 'like', '%'.$cliente.'%')
                ->where('activo', 1)->where('id', '!=', 1)
                ->orderBy('id')
                ->paginate(5)->setPath('');

            $activos->appends(['apellidos' => $cliente]);

            return view('clientes.indexA', compact('activos'));
        }

        return view('clientes.indexA', compact('activos'));
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

        $cliente = Cliente::findOrFail($id);

        return view('clientes.show', compact('cliente'));        
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

    public function imprimirClientes() {

        $clientes = Cliente::where('id', '!=', 1)->get();

        $pdf = \PDF::loadView('pdf.pdfClientes', compact('clientes'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Clientes.pdf');
    }

    public function imprimirActivos() {

        $clientes = Cliente::where('activo', 1)->where('id', '!=', 1)->get();

        $pdf = \PDF::loadView('pdf.pdfClientesA', compact('clientes'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('ClientesA.pdf');
    }

    public function exportar() {

        return Excel::download(new UsersExport, 'Usuarios.xls');
    }

    public function exportarA() {

        return Excel::download(new UsersAExport, 'UsuariosActivos.xls');
    }
}
