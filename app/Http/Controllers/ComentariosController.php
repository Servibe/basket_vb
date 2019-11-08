<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;

class ComentariosController extends Controller
{
    //

    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	$comentarios = Comentario::orderby('id', 'DESC')->paginate(10);

    	return view('comentarios.index', compact('comentarios'));
    }

    public function store(Request $request) {

    	$this->validate($request, ['contenido' => 'required|min:10|max:1000']);

    	$comentario = new Comentario();

    	$comentario->contenido = $request->contenido;
    	$comentario->user_id = \Auth::user()->id;

    	if ($comentario->save()) {
    		return redirect('/comentarios');
    	}
    }
}
