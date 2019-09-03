@extends('layouts.print')

<style>
        .invoice-content { font-size: 11px; }

        table {
            width: 100%;
            /* border: 1px solid black; */
        }
        table > tbody > tr > td {
            /* border: 1px solid black; */
        }

        .line-bottom { border-bottom: 1px solid #ddd; }

        .bg-danger{ color:red; }
        .bg-warning{ color:orange; }
        .bg-success{ color:green; }
</style>

@php
    CONST PATH_PARTIALS = 'laboratorio.patologia-clinica.ordenes.partials-imprimir.';
@endphp

<section class="invoice">
    <div class="row invoice-content">
        <div class="col-xs-12">
            <table >
                <thead>
                    @include(PATH_PARTIALS.'header')
                </thead>
                <tbody>
                    @include(PATH_PARTIALS.'areas')
                </tbody>
            </table>
        </div>
    </div>
</section>