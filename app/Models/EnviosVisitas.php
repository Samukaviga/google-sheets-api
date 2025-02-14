<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnviosVisitas extends Model
{
    protected $fillable = [
        'unidade',
        'data',
        'semana',
        'meta_envios',
        'enviados',
        'faltou',
        'meta_agendamentos',
        'agendamentos',
        'meta_visitas',
        'visitas_realizadas',
        'status',
    ];
}
