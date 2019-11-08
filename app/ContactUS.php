<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUS extends Model
{
    //

    public $table = 'contactus';

    protected $fillable = [
    	"name",
    	"email",
    	"message"
    ];
}
