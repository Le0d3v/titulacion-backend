<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferenciaRequest;
use App\Models\Archivo;
use App\Models\Proceso;
use App\Models\User;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function referenciaStore(ReferenciaRequest $request)
    {
        $data = $request->validated();

        $proceso = Proceso::find($data["id"]);
        $archivo = Archivo::find($data["id"]);

        $archivo->referencia_pago = $data["referencia_pago"];
        $proceso->pago_titulo = 2;

        $archivo->save();
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Referencia Registrada"
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Archivo $archivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Archivo $archivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archivo $archivo)
    {
        //
    }
}
