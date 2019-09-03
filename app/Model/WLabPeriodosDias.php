<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WLabPeriodosDias extends Model
{
    protected $table = "WLabPeriodosDias";

    protected $primaryKey = 'IdPeriodoDia';

    public $timestamps = false;

    // protected $fillable = ['IdPeriodo', 'IdIndicador', 'Dia', 'Valor'];
}
