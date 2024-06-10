<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $table = 'expediente';

    protected $fillable = [
        'id_paciente',
        'fecha_reg',
        'fecha_act',
        'seguimiento',
        'archivos'
    ];
}
