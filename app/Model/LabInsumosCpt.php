<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LabInsumosCpt extends Model
{
    protected $table = "LabInsumosCpt";

    protected $primaryKey = 'IdInsumo';

    protected $fillable= ['IdProductoInsumo', 'IdProductoServicio', 'Cantidad', 'Unidad'];

    public $timestamps = false;

}
