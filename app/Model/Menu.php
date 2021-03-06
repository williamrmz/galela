<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public static function data()
    {
        $items = 
        [
            [
                'key' => 'fact-config',
                'label' => 'Fact - Config',
                'icon' => 'fa fa-dashboard',
                'url' => '/',
                'items' => [
                    [
                        'key' => 'fact-config.catalogo-bienes-insumos',
                        'label' => 'Catalogo de bienes e insumos',
                        'icon' => 'fa fa-circle-o',
                        'url' => '/fact-config/catalogo-bienes-insumos',
                    ],
                    [
                        'key' => 'fact-config.catalogo-servicios',
                        'label' => 'Catalogo de servicios',
                        'icon' => 'fa fa-circle-o',
                        'url' => '/fact-config/catalogo-servicios',
                    ],
                    [
                        'key' => 'fact-config.resultados-laboratorio',
                        'label' => 'Config. resultados de laboratorio',
                        'icon' => 'fa fa-circle-o',
                        'url' => '/fact-config/resultados-laboratorio',
                    ],
                ],
            ],
            [
                'key' => 'lab',
                'label' => 'Laboratorio',
                'icon' => 'fa fa-dashboard',
                'url' => '/',
                'items' => [
                    [
                        'key' => 'lab.insumos',
                        'label' => 'Insumos',
                        'icon' => 'fa fa-circle-o',
                        'url' => '/laboratorio/insumos',
                    ],
                    [
                        'key' => 'lab.pat-clinica',
                        'label' => 'Pat. Clinica',
                        'icon' => 'fa fa-circle-o',
                        'url' => '/laboratorio/patologia-clinica',
                    ],
                ],
            ],
        ];



        // dd($items);
        $items = \Auth::user()->menu();

        //Se modifica temporalmente el ruteo del modulo de laboratorio;
        if( isset( $items['LA']) ){

            // LA.OrdenesLaboratorio
            // dd( $items['LA'] );
            array_push( $items['LA']['items'], [
                "id" => "0000",
                "key" => "LA.IN",
                "index" => "4",
                "label" => "Insumos",
                "icon" => "fa fa-briefcase text-purple",
                "url" => "/laboratorio/insumos",
            ] );
        }
        // dd($items);
        return json_decode(json_encode($items));
    }

}
