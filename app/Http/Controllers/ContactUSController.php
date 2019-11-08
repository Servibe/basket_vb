<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUS;
use Mail;
use Auth;

class ContactUSController extends Controller
{
    
    public function contactUS() {

        return view('contactUS');
    }

    public function contactUSPost(Request $request) {

        $this->validate($request, ['name' => 'required', 'email' => 'required', 'message' => 'required']);

        ContactUS::create($request->all());

        Mail::send('contacto', ['name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')], function($message) {
                $message->from('svitalb04@gmail.com', 'CM');
                $message->to('svitalb04@gmail.com', 'Vibe')->subject('Basket VB Feedback');
            });

        return back()->with('success', 'Gracias por contactar nos!');
    }
}
