<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Archivo;
use App\Models\Proceso;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PDFRequest;
use App\Http\Requests\ReferenciaRequest;

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
    
    public function memoriaStore(PDFRequest $request) {

        $data = $request->validated();

        $proceso = Proceso::find($data["id"]);
        $archivo = Archivo::find($data["id"]);

        $nombreArchivo = Str::random(40) . '.pdf';

        $path = $request->file('pdf')->storeAs('pdfs/memorias/', $nombreArchivo, 'public');

        $proceso->validacion_memoria_estadia = 2;
        $archivo->memoria_estadia = $nombreArchivo;

        $proceso->save();
        $archivo->save();

        return [
            "status" => 200,
            "message" => "Archivo Registrado"
        ];
    }

    public function comprobanteStore(PDFRequest $request) {

        $data = $request->validated();

        $proceso = Proceso::find($data["id"]);
        $archivo = Archivo::find($data["id"]);

        $nombreArchivo = Str::random(40) . '.pdf';

        $path = $request->file('pdf')->storeAs('pdfs/comprobantes/', $nombreArchivo, 'public');

        $proceso->pago_donacion = 2;
        $archivo->comprobante_donacion = $nombreArchivo;

        $proceso->save();
        $archivo->save();

        return [
            "status" => 200,
            "message" => "Archivo Registrado"
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
