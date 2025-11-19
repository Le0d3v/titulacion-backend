<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Models\Proceso;
use App\Models\User;
use Illuminate\Http\Request;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Proceso $proceso)
    {
        //
    }

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proceso $proceso)
    {
        //
    }
}
