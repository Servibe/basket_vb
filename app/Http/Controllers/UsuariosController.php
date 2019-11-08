<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cliente;
use Hash;
use Auth;
use App\Mail\Borrada;
use App\Mail\Desactivada;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['recuperar']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $usuario = User::findOrFail($id);

        return view('usuarios.show', compact('usuario'));
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

        $usuario = User::where('id', $id)->update(['password' => null, 'activo' => $request->activo, 'recibir_ofertas' => 0]);

        if ($usuario) {

            $cliente = \DB::table('clientes')->where('user_id', Auth::user()->id)->update(['activo' => 0]);

            if ($cliente) {

                $email = Auth::user()->email;

                \Mail::to($email)->send(new Desactivada);

                \Session::flush();

                return redirect('/');
            } else {
                $usuario = User::where('id', $id)->update(['password' => Hash::make(123456789), 'activo' => 1]);

                $cliente = \DB::table('clientes')->where('user_id', Auth::user()->id)->update(['activo' => 1]);

                \Flash::warning('Ha ocurrido algo inesperado al final. Contraseña: 123456789');

                return redirect('/');
            }
        } else {
            $usuario = User::where('id', $id)->update(['password' => Hash::make(123456789), 'activo' => 1]);

            \Flash::warning('Al haber fallado la eliminacion, tu contraseña actual es 123456789. Ve a tu perfil si deseas cambiarla.');

            return redirect('/');
        }
    }

    public function cambiar() {
        return view('usuarios.edit');
    }

    public function actualizar(Request $request) {

        if (\Input::get('recibir_ofertas') === '0') {
            $usuario = \DB::table('users')
            ->join('clientes', 'users.id', '=', 'clientes.user_id')
            ->where('users.id', '=', Auth::user()->id)
            ->update($request->except(['_token', 'activo']));
        } else {
            $usuario = \DB::table('users')
            ->join('clientes', 'users.id', '=', 'clientes.user_id')
            ->where('users.id', '=', Auth::user()->id)
            ->update($request->except(['_token', 'activo']));
        }

        if ($usuario) {
            \Flash::success('Los datos se han actualizado correctamente');

            return redirect('/usuarios/'. Auth::user()->id);
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

    public function eliminar(Request $request, $id) {

        $username = User::select('username')->where('id', $id)->first()->username;

        $email = Auth::user()->email;

        if ($email) {
            \Mail::to($email)->send(new Borrada);
        }

        $usuario = User::where('id', $id)->update(['email' => null, 'password' => null, 'activo' => $request->activo, 'recibir_ofertas' => $request->recibir_ofertas]);

        if ($usuario) {
            
            $cliente = Cliente::where('user_id', $id)->update(['activo' => 0]);

            \Session::flush();

            \Flash::success('La eliminación de tu cuenta <b>' . $username . '</b> se ha realizado de forma satisfactoria.');

            return redirect('/');
        }
    }

    public function password() {
        return view('usuarios.password');
    }

    public function updatePassword(Request $request) {

        $rules = [
        'mypassword' => 'required',
        'password' => 'required|confirmed|min:6',
        ];

        $messages = [
        'mypassword.required' => 'El campo es requerido',
        'password.required' => 'El campo es requerido',
        'password.confirmed' => 'Los passwords no coinciden',
        'password.min' => 'El mínimo permitido son 6 caracteres',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/usuario/password')->withErrors($validator);
        } else {
            if (Hash::check($request->mypassword, Auth::user()->password)) {

                $user = User::where('email', Auth::user()->email)->update(['password' => bcrypt($request->password)]);

                \Flash::success('La contraseña se ha actualizado correctamente, ' . Auth::user()->username);

                return redirect('/home')->with('status', 'Password cambiada con éxito');
            } else {
                return redirect('/usuario/password')->with('message', 'Credenciales incorrectas');
            }
        }
    }

    public function recuperar(Request $request) {

        error_reporting(0);

        $usuario = User::select('email')->where('email', $request->email)->first()->email;


        if ($usuario) {

            $usuario_password = User::select('password')->where('email', $usuario)->first()->password;

            if ($usuario_password == null) {

                $recuperar = User::where('email', $usuario)->update(['password' => Hash::make($request->password), 'activo' => 1, 'recibir_ofertas' => 1]);

                if ($recuperar) {

                    $cliente = User::select('id')->where('email', $usuario)->first()->id;

                    $recuperar_cliente = Cliente::where('user_id', $cliente)->update(['activo' => 1]);

                    if ($recuperar_cliente) {
                        $username = User::where('email', $usuario)->first()->username;

                        \Flash::success('Su cuenta ha sido reestablecida satisfactoriamente. Inicie sesión por favor. Su Username era <b>' . $username . '</b>');

                        return redirect('/login');
                    } else {
                        $quitar = User::where('email', $usuario)->update(['password' => null, 'activo' => 0, 'recibir_ofertas' => 0]);

                        \Flash::warning('Su cuenta no se ha reestablecido en el último momento.');

                        return redirect('/');
                    }
                }
            } else {
                \Flash::warning('El correo que ha sido introducido esta en uso.');

                return redirect('/');
            }
        } else {
            \Flash::warning('El correo que ha sido introducido no existe.');

            return redirect('/');
        }
    }
}
