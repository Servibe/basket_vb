<?php

namespace App\Exports;

use App\User;
use App\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersAExport implements FromCollection, WithHeadings
{
	/**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array {

    	return [
        'Id',
        'Username',
        'Nombre',
        'Apellidos',
        'Email',
        'Localidad',
        'Provincia',
        'Calle',
        'Código Postal',
        ];
    }

    public function collection() {

        $usuarios = \DB::table('users')
        ->join('clientes', 'users.id', '=', 'clientes.user_id')
        ->select('users.id', 'users.username', 'clientes.nombre', 'clientes.apellidos', 'users.email', 'clientes.localidad', 'clientes.provincia', 'clientes.calle', 'clientes.cod_postal')
        ->where('users.activo', 1)->where('users.id', '!=', 1)
        ->get();

        return $usuarios;
    }
}