<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Models\Proceso;
use App\Models\User;
use Illuminate\Http\Request;

class ProcesoController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function updateEncuesta(Request $request)
    {
        $proceso = Proceso::find($request->id);

        if(!$proceso) {
            return [
                "status" => "error",
                "message" => "El proceso no se encontró"
            ];
        }

        $proceso->encuesta_egresados = 1;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Encuesta Realizada"
        ];
    }

    public function aprobarEncuesta(Request $request) {
        $request->validate([
            "id" => "required|numeric"
        ]);

        $proceso = Proceso::find($request->id);

        if(!$proceso) {
            return [
                "status" => 404,
                "message" => "No se encontró el proceso"
            ];
        }

        $proceso->validacion_memoria_estadia = 1;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Proceso Aceptado"
        ];
    }
    
    public function rechazarEncuesta(Request $request) {
        $request->validate([
            "id" => "required|numeric"
        ]);

        $proceso = Proceso::find($request->id);

        if(!$proceso) {
            return [
                "status" => 404,
                "message" => "No se encontró el proceso"
            ];
        }

        $proceso->validacion_memoria_estadia = 3;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Proceso Rechazado"
        ];
    }
    public function aprobarComprobante(Request $request) {
        $request->validate([
            "id" => "required|numeric"
        ]);

        $proceso = Proceso::find($request->id);

        if(!$proceso) {
            return [
                "status" => 404,
                "message" => "No se encontró el proceso"
            ];
        }

        $proceso->pago_donacion = 1;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Proceso Aceptado"
        ];
    }

    public function rechazarComprobante(Request $request) {
        $request->validate([
            "id" => "required|numeric"
        ]);

        $proceso = Proceso::find($request->id);

        if(!$proceso) {
            return [
                "status" => 404,
                "message" => "No se encontró el proceso"
            ];
        }

        $proceso->pago_donacion = 3;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Proceso Rechazado"
        ];
    }
    public function aprobarImagen(Request $request) {
        $request->validate([
            "id" => "required|numeric"
        ]);

        $proceso = Proceso::find($request->id);

        if(!$proceso) {
            return [
                "status" => 404,
                "message" => "No se encontró el proceso"
            ];
        }

        $proceso->carga_imagen = 1;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Imágen Aprobada"
        ];
    }

    public function rechazarReferencia(Request $request) {
        $request->validate([
            "id" => "required|numeric"
        ]);

        $proceso = Proceso::find($request->id);

        if(!$proceso) {
            return [
                "status" => 404,
                "message" => "No se encontró el proceso"
            ];
        }

        $proceso->pago_titulo = 3;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Referencia Rechazada"
        ];
    }
    
    public function aprobarReferencia(Request $request) {
        $request->validate([
            "id" => "required|numeric"
        ]);

        $proceso = Proceso::find($request->id);

        if(!$proceso) {
            return [
                "status" => 404,
                "message" => "No se encontró el proceso"
            ];
        }

        $proceso->pago_titulo = 1;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Referencia Aprobada"
        ];
    }

    public function rechazarImagen(Request $request) {
        $request->validate([
            "id" => "required|numeric"
        ]);

        $proceso = Proceso::find($request->id);

        if(!$proceso) {
            return [
                "status" => 404,
                "message" => "No se encontró el proceso"
            ];
        }

        $proceso->carga_imagen = 3;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Imágen Rechazada"
        ];
    }
}
