<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Producto;

class CartController extends Controller
{

    public function __construct() {

        if (!Session::has('cart')) {
            Session::put('cart', array());
        }
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
    public function add(Producto $producto)
    {
        //
        $cart = Session::get('cart');



        $producto->stock_actual = 1;

        $cart[$producto->id] = $producto;

        Session::put('cart', $cart);

        \Flash::info($producto->nombre . ' añadido al carrito!');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $cart = Session::get('cart');

        $total = $this->total();

        \Flash::info('Revisa los precios de tu carrito si has comprado justo en el fin de la rebaja o del dia sin IVA. ¡No queremos sustos!');

        return view('store.cart', compact('cart', 'total'));
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
    public function update(Producto $producto, $stock_actual)
    {
        //
        $cart = Session::get('cart');

        $cart[$producto->id]->stock_actual = $stock_actual;

        Session::put('cart', $cart);

        return redirect()->route('cart-show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Producto $producto)
    {
        //
        $cart = Session::get('cart');

        unset($cart[$producto->id]);

        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function trash() {

        Session::forget('cart');

        return redirect()->route('cart-show');
    }

    public function total() {

        $cart = Session::get('cart');
 
        $total = 0;

        foreach ($cart as $item) {
            $total += ($item->pvp + ($item->pvp * ($item->iva/100))) * $item->stock_actual;
        }

        return $total;
    }

    public function orderDetail() {

        if (count(Session::get('cart')) <= 0) {
            return redirect('/productosC');
        }

        $cart = Session::get('cart');

        $total = $this->total();
        
        return view('store.order-detail', compact('cart', 'total'));
    }
}
