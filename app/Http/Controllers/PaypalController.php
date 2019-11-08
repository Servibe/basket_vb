<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Pedido;
use App\PedidoItem;
use App\Producto;
use App\Mail\Admin;
use App\Mail\UserM;

class PaypalController extends Controller
{
    //
    private $_api_context;
	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}
	public function postPayment()
	{
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		$items = array();
		$subtotal = 0;
		$cart = \Session::get('cart');
		$currency = 'EUR';
		foreach($cart as $producto){
			$item = new Item();
			$item->setName($producto->nombre)
			->setCurrency($currency)
			->setQuantity($producto->stock_actual)
			->setPrice(number_format($producto->pvp + ($producto->pvp * ($producto->iva/100)), 2));
			$items[] = $item;
			$subtotal += number_format(($producto->pvp + ($producto->pvp * ($producto->iva/100))) * $producto->stock_actual, 2);
		}
		$item_list = new ItemList();
		$item_list->setItems($items);
		$details = new Details();
		$details->setSubtotal($subtotal)
		->setShipping(7);
		$total = $subtotal + 7;
		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Realización de pedido desde Basket VB');
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('payment.status'))
			->setCancelUrl(\URL::route('payment.status'));
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Ups! Algo salió mal');
			}
		}
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
		// add payment ID to session
		\Session::put('paypal_payment_id', $payment->getId());
		if(isset($redirect_url)) {
			// redirect to paypal
			return \Redirect::away($redirect_url);
		}
		return \Redirect::route('cart-show')
			->with('error', 'Ups! Error desconocido.');
	}

	public function getPaymentStatus()
	{
		// Get the payment ID before session clear
		$payment_id = \Session::get('paypal_payment_id');
		// clear the session payment ID
		\Session::forget('paypal_payment_id');
		$payerId = \Input::get('PayerID');
		$token = \Input::get('token');
		//if (empty(\Input::get('PayerID')) || empty(\Input::get('token'))) {
		if (empty($payerId) || empty($token)) {
			return \Redirect::route('productosC.index')
				->with('message', 'Hubo un problema al intentar pagar con Paypal');
		}
		$payment = Payment::get($payment_id, $this->_api_context);
		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(\Input::get('PayerID'));
		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);
		//echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
		if ($result->getState() == 'approved') { // payment made
			// Registrar el pedido --- ok
			// Registrar el Detalle del pedido  --- ok
			// Eliminar carrito 
			// Enviar correo a user
			// Enviar correo a admin
			// Redireccionar
			$this->saveOrder(\Session::get('cart'));

			\Session::forget('cart');

			$correo = \Auth::user()->email;
			\Mail::to($correo)->send(new UserM);

			$correoA = 'svitalb04@gmail.com';
			\Mail::to($correoA)->send(new Admin);

			return \Redirect::route('productosC.index')
				->with('message', 'Compra realizada de forma correcta');
		}
		return \Redirect::route('productosC.index')
			->with('message', 'La compra fue cancelada');
	}
	private function saveOrder($cart)
	{
	    $subtotal = 0;
	    foreach($cart as $item){
	        $subtotal += number_format(($item->pvp + ($item->pvp * ($item->iva/100))) * $item->stock_actual, 2);
	    }
	    
	    $pedido = Pedido::create([
	        'subtotal' => $subtotal,
	        'envio' => 7,
	        'user_id' => \Auth::user()->id,
	        'factura_id' => 0,
	        'fecha_pedido' => now()->toDateString(),
	        'fecha_envio' => $this->fecha_envio(),
	        'fecha_entrega' => $this->fecha_entrega(),
	        'metodo_pago' => 'PayPal'
	    ]);
	    
	    foreach($cart as $item){
	        $this->saveOrderItem($item, $pedido->id);
	    }
	}
	
	private function saveOrderItem($item, $pedido_id)
	{
		\DB::table('productos')->where('id', $item->id)
		->decrement('stock_actual', $item->stock_actual);

		$inferior = Producto::where('stock_actual', '<=', 10)->get();

        if ($inferior) {
            $automatico = Producto::where('stock_actual', '<=', 10)
            ->update(['stock_actual' => 100]);
        }

        if (($item->rebajado) == 0) {
        	$item->rebajado = 0;
        } else {
        	$item->rebajado = 1;
        }

		PedidoItem::create([
			'unidades' => $item->stock_actual,
			'precio' => number_format($item->pvp + ($item->pvp * ($item->iva/100)), 2),
			'rebaja' => $item->rebajado,
			'producto_id' => $item->id,
			'pedido_id' => $pedido_id
		]);
	}

	private function fecha_entrega() {

		$festivos = [
			'2019-01-01',
			'2019-01-07',
			'2019-04-18',
			'2019-04-19',
			'2019-05-01',
			'2019-08-15',
			'2019-09-09',
			'2019-10-12',
			'2019-11-01',
			'2019-12-06',
			'2019-12-09',
			'2019-12-25',
		];

		$findes = [
			'2019-01-05','2019-01-06','2019-01-12','2019-01-13','2019-01-19','2019-01-20','2019-01-26','2019-01-27',
			'2019-02-02','2019-02-03','2019-02-09','2019-02-10','2019-02-16','2019-02-17','2019-02-23','2019-02-24',
			'2019-03-02','2019-03-03','2019-03-09','2019-03-10','2019-03-16','2019-03-17','2019-03-23','2019-03-24','2019-03-30','2019-03-31',
			'2019-04-06','2019-04-07','2019-04-13','2019-04-14','2019-04-20','2019-04-21','2019-04-27','2019-04-28',
			'2019-05-04','2019-05-05','2019-05-11','2019-05-12','2019-05-18','2019-05-19','2019-05-25','2019-05-26',
			'2019-06-01','2019-06-02','2019-06-08','2019-06-09','2019-06-15','2019-06-16','2019-06-22','2019-06-23','2019-06-29','2019-06-30',
			'2019-07-06','2019-07-07','2019-07-13','2019-07-14','2019-07-20','2019-07-21','2019-07-27','2019-07-28',
			'2019-08-03','2019-08-04','2019-08-10','2019-08-11','2019-08-17','2019-08-18','2019-08-24','2019-08-25','2019-08-31',
			'2019-09-01','2019-09-07','2019-09-08','2019-09-14','2019-09-15','2019-09-21','2019-09-22','2019-09-28','2019-09-29',
			'2019-10-05','2019-10-06','2019-10-13','2019-10-19','2019-10-20','2019-10-26','2019-10-27',
			'2019-11-02','2019-11-03','2019-11-09','2019-11-10','2019-11-16','2019-11-17','2019-11-23','2019-11-24','2019-11-30',
			'2019-12-01','2019-12-07','2019-12-08','2019-12-14','2019-12-15','2019-12-21','2019-12-22','2019-12-28','2019-12-29',
		];

		$hoy = date('Y-m-d');

		$fecha = date("Y-m-d", strtotime("+4 days", strtotime($hoy)));

		if (in_array($fecha, $findes)) {

			$final = strtotime('+2 days', strtotime($fecha));

			$final = date('Y-m-d', $final);

			return $final;
		} else if (in_array($fecha, $festivos)) {

			$final = strtotime('+8 days', strtotime($fecha));

			$final = date('Y-m-d', $final);

			return $final;	
		} else if ($fecha == $this->fecha_envio()) {
			$final = strtotime('+2 days', strtotime($fecha));

			$final = date('Y-m-d', $final);

			return $final;
		} else {
			return $fecha;
		}
	}

	private function fecha_envio() {

		$festivos = [
			'2019-01-01',
			'2019-01-07',
			'2019-04-18',
			'2019-04-19',
			'2019-05-01',
			'2019-08-15',
			'2019-09-09',
			'2019-10-12',
			'2019-11-01',
			'2019-12-06',
			'2019-12-09',
			'2019-12-25',
		];

		$findes = [
			'2019-01-05','2019-01-06','2019-01-12','2019-01-13','2019-01-19','2019-01-20','2019-01-26','2019-01-27',
			'2019-02-02','2019-02-03','2019-02-09','2019-02-10','2019-02-16','2019-02-17','2019-02-23','2019-02-24',
			'2019-03-02','2019-03-03','2019-03-09','2019-03-10','2019-03-16','2019-03-17','2019-03-23','2019-03-24','2019-03-30','2019-03-31',
			'2019-04-06','2019-04-07','2019-04-13','2019-04-14','2019-04-20','2019-04-21','2019-04-27','2019-04-28',
			'2019-05-04','2019-05-05','2019-05-11','2019-05-12','2019-05-18','2019-05-19','2019-05-25','2019-05-26',
			'2019-06-01','2019-06-02','2019-06-08','2019-06-09','2019-06-15','2019-06-16','2019-06-22','2019-06-23','2019-06-29','2019-06-30',
			'2019-07-06','2019-07-07','2019-07-13','2019-07-14','2019-07-20','2019-07-21','2019-07-27','2019-07-28',
			'2019-08-03','2019-08-04','2019-08-10','2019-08-11','2019-08-17','2019-08-18','2019-08-24','2019-08-25','2019-08-31',
			'2019-09-01','2019-09-07','2019-09-08','2019-09-14','2019-09-15','2019-09-21','2019-09-22','2019-09-28','2019-09-29',
			'2019-10-05','2019-10-06','2019-10-13','2019-10-19','2019-10-20','2019-10-26','2019-10-27',
			'2019-11-02','2019-11-03','2019-11-09','2019-11-10','2019-11-16','2019-11-17','2019-11-23','2019-11-24','2019-11-30',
			'2019-12-01','2019-12-07','2019-12-08','2019-12-14','2019-12-15','2019-12-21','2019-12-22','2019-12-28','2019-12-29',
		];

		$hoy = date('Y-m-d');

		$fecha = date("Y-m-d", strtotime("+1 days", strtotime($hoy)));

		if (in_array($fecha, $findes)) {

			$final = strtotime('+2 days', strtotime($fecha));

			$final = date('Y-m-d', $final);

			return $final;
		}
		else if (in_array($fecha, $festivos)) {

			$final = strtotime('+2 days', strtotime($fecha));

			$final = date('Y-m-d', $final);

			return $final;	
		}
		else {
			return $fecha;
		}
	}
}
