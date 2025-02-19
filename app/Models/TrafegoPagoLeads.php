<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafegoPagoLeads extends Model
{
    
    protected $table = 'trafego_pago_leads';

    protected $fillable = [
    'unidade',
    'data',
    'semana',
    'meta_gasto_original',
    'meta_gasto',
    'valor_gasto',
    'status',
    'impressoes',
    'clique_no_link',
    'leads',
    'valor_do_lead',
    'acumulado_meta',
    'acumulado_gasto',
    'diferenca',
    ];

}
