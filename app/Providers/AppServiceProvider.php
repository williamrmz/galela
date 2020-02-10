<?php

namespace App\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function(string $attribute, string $searchTerm)
        {
            return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });

        Builder::macro('whereTrim', function(string $attribute, string $value)
        {
            return $this->whereRaw("LTRIM(RTRIM($attribute)) = LTRIM(RTRIM($value))");
        });

        // Agregar macro para que Form retorne meses
        FormBuilder::macro('selectMes', function($name, $IdMesSeleccion)
        {
            $meses = [
                "01" => "Enero",
                "02" => "Febrero",
                "03" => "Marzo",
                "04" => "Abril",
                "05" => "Mayo",
                "06" => "Junio",
                "07" => "Julio",
                "08" => "Agosto",
                "09" => "Septiembre",
                "10" => "Octubre",
                "11" => "Noviembre",
                "12" => "Diciembre",
            ];

            $rpta = "<select name='$name' class='form-control'>";
            foreach ($meses as $clave => $mes)
            {
                $seleccion = ($clave==$IdMesSeleccion)?"selected":"";
                $rpta.="<option value='$clave' $seleccion>$mes</option>";
            }
            $rpta.= "</select>";
            return $rpta;
        });
    }
}
