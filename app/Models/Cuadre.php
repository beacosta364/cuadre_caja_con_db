<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuadre extends Model
{
    protected $fillable = [
    'fecha','total_venta','propina','domicilio',
    'red1','red2','red3','red4','red5','red6',
    'transferencias','cuenta_cobrar','gastos','efectivo_oficina'
];
}


