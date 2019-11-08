<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //

    protected $fillable = [
    	'contenido',
    	'user_id'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
