<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComentarioRequest;
use App\Models\ComentariosProceso;
use App\Models\Proceso;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(ComentarioRequest $request) {
        $data = $request->validated();

        ComentariosProceso::create([
            "proceso_id" => $data["proceso_id"],
            "subproceso" => $data["subproceso"],
            "comentario" => $data["comentario"],
        ]);   

         return [
            "status" => 200,
            "message" => "Se envió el comentario"
        ];
    }
}
