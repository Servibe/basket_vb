<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Zipper;
use Cookie;

class WallpapersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {

    	$productos = Producto::where('tipo_producto', '=', '17')->where('activo', 1)
        ->orderBy('id', 'ASC')
        ->paginate(9);

        return response(view('wallpapers.index', compact('productos')))
        ->cookie('wallpapers_cookie', 'wallpapers.index', 10080);
    }

    public function ordenador() {

        $ordenadores = Producto::where('tipo_producto', 17)->where('activo', 1)
        ->where('nombre', 'like', '%computer%')
        ->orderBy('nombre')
        ->paginate(9);

        return response(view('wallpapers.ordenadores', compact('ordenadores')))
        ->cookie('ordenadores_cookie', 'wallpapers.ordenadores', 10080);
    }

    public function movil() {

        $moviles = Producto::where('tipo_producto', 17)->where('activo', 1)
        ->where('nombre', 'like', '%phone%')
        ->orderBy('nombre')
        ->paginate(9);

        return response(view('wallpapers.moviles', compact('moviles')))
        ->cookie('moviles_cookie', 'wallpapers.moviles', 10080);
    }

    public function imprimirWallpapers() {

        $productos = Producto::where('activo', 1)->where('tipo_producto', '=', '17')->get();

        $pdf = \PDF::loadView('pdf.pdfWallpapers', compact('productos'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Wallpapers.pdf');
    }

    public function comprimirDescarga(Request $request) {

        $nombre = $request->get('foto');

        $files = glob(public_path('images/'.$nombre));

        Zipper::make(public_path('app/public/'.$nombre.'.zip'))->add($files)->close();

        return response()->download(public_path('app/public/'.$nombre.'.zip'));
    }
}
