<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\WebGermenes as Germen;

class ConfigAntibiogramaController extends Controller
{
    const PATH_VIEW = 'laboratorio.patologia-clinica.config-antibiograma.';

    public function index(Request $request)
    {
        return view(self::PATH_VIEW.'index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function delete($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
