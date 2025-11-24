<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Archivo;
use App\Models\Proceso;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PDFRequest;
use App\Http\Requests\ImagenRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ReferenciaRequest;
use App\Models\ComentariosProceso;

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
    
    public function memoriaStore(PDFRequest $request) {
        $data = $request->validated();

        $proceso = Proceso::findOrFail($data["id"]);
        $archivo = Archivo::findOrFail($data["id"]);
        $usuario = User::findOrFail($data["id"]);

        $nombreArchivo = $request->file("pdf")->getClientOriginalName();
        $rutaFisica = public_path("storage/pdfs/memorias/");

        if (!file_exists($rutaFisica)) {
            mkdir($rutaFisica, 0775, true);
        }

        $rutaArchivo = $rutaFisica . $nombreArchivo;

        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        $request->file("pdf")->move($rutaFisica, $nombreArchivo);
        $archivo->memoria_estadia = $nombreArchivo;
        $archivo->save();
        
        if($nombreArchivo != "Memoria_Estadia_$usuario->matricula.pdf") {
            $proceso->validacion_memoria_estadia = 3;
            $proceso->save();

            $comentario = ComentariosProceso::create([
                "proceso_id" => $proceso->id,
                "subproceso" => "memoria",
                "comentario" => "El PDF no tiene el nombre solicitado, por favor modifícalo."
            ]);

            return [
                "status" => 200,
                "message" => "Archivo registrado correctamente"
            ];
        } 

        $proceso->validacion_memoria_estadia = 1;
        $proceso->save();

        $comentario = ComentariosProceso::create([
            "proceso_id" => $proceso->id,
            "subproceso" => "memoria",
            "comentario" => "Archivo validado y aceptado."
        ]);

        return [
            "status" => 200,
            "message" => "Archivo registrado correctamente"
        ];

    }

    public function comprobanteStore(PDFRequest $request) {
        $data = $request->validated();

        $proceso = Proceso::findOrFail($data["id"]);
        $archivo = Archivo::findOrFail($data["id"]);
        $usuario = User::findOrFail($data["id"]);

        $nombreArchivo = $request->file("pdf")->getClientOriginalName();
        $rutaFisica = public_path("storage/pdfs/comprobantes/");

        if (!file_exists($rutaFisica)) {
            mkdir($rutaFisica, 0775, true);
        }

        $rutaArchivo = $rutaFisica . $nombreArchivo;

        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        $request->file("pdf")->move($rutaFisica, $nombreArchivo);
        $archivo->comprobante_donacion = $nombreArchivo;
        $archivo->save();
        
        if($nombreArchivo != "Comprobante_Donacion_$usuario->matricula.pdf") {
            $proceso->pago_donacion = 3;
            $proceso->save();

            $comentario = ComentariosProceso::create([
                "proceso_id" => $proceso->id,
                "subproceso" => "comprobante",
                "comentario" => "El PDF no tiene el nombre solicitado, por favor modificalo."
            ]);

            return [
                "status" => 200,
                "message" => "Archivo registrado correctamente"
            ];
        } 

        $proceso->pago_donacion = 1;
        $proceso->save();

        $comentario = ComentariosProceso::create([
            "proceso_id" => $proceso->id,
            "subproceso" => "comprobante",
            "comentario" => "Archivo validado y aceptado."
        ]);

        return [
            "status" => 200,
            "message" => "Archivo registrado correctamente"
        ];
    }

    public function imagenStore(ImagenRequest $request) {
        $data = $request->validated();

        $proceso = Proceso::findOrFail($data["id"]);
        $archivo = Archivo::findOrFail($data["id"]);
        $user = User::findOrFail($data["id"]);

        $extension = $request->file("imagen")->getClientOriginalExtension();
        $nombreArchivo = "imagen_{$user->matricula}.{$extension}";

        $rutaFisica = public_path("/storage/imagenes/");

        if (!file_exists($rutaFisica)) {
            mkdir($rutaFisica, 0775, true);
        }

        $rutaArchivo = $rutaFisica . $nombreArchivo;

        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        $request->file("imagen")->move($rutaFisica, $nombreArchivo);

        $proceso->carga_imagen = 2;
        $archivo->imagen_titulacion = $nombreArchivo;

        $proceso->save();
        $archivo->save();

        return [
            "status" => 200,
            "message" => "Archivo registrado correctamente"
        ];

    }

    public function memoriaDestroy($id) {
        $archivo = Archivo::find($id);
        $proceso = Proceso::find($id);

        if (!$archivo || !$proceso) {
            return [
                "status" => 404,
                "message" => "Archivo o Proceso no encontrado"
            ];
        }

        $ruta = public_path('/storage/pdfs/memorias/' . $archivo->memoria_estadia);

        if (file_exists($ruta)) {
            if (unlink($ruta)) {
                $archivo->memoria_estadia = null;
                $proceso->validacion_memoria_estadia = 0;

                $archivo->save();
                $proceso->save();

                return [
                    "status" => 200,
                    "message" => "Archivo Eliminado"
                ];
            } else {
                return [
                    "status" => 500,
                    "message" => "Error al eliminar el archivo del sistema"
                ];
            }
        } else {
            return [
                "status" => 404,
                "message" => "Archivo no encontrado en el sistema de archivos"
            ];
        }
    }
    public function comprobanteDestroy($id) {
        $archivo = Archivo::find($id);
        $proceso = Proceso::find($id);

        if (!$archivo || !$proceso) {
            return [
                "status" => 404,
                "message" => "Archivo o Proceso no encontrado"
            ];
        }

        $ruta = public_path('/storage/pdfs/comprobantes/' . $archivo->comprobante_donacion);

        if (file_exists($ruta)) {
            if (unlink($ruta)) {
                $archivo->comprobante_donacion = null;
                $proceso->pago_donacion = 0;

                $archivo->save();
                $proceso->save();

                return [
                    "status" => 200,
                    "message" => "Archivo Eliminado"
                ];
            } else {
                return [
                    "status" => 500,
                    "message" => "Error al eliminar el archivo del sistema"
                ];
            }
        } else {
            return [
                "status" => 404,
                "message" => "Archivo no encontrado en el sistema de archivos"
            ];
        }
    }

    public function imagenDestroy($id) {
        $archivo = Archivo::find($id);
        $proceso = Proceso::find($id);

        if (!$archivo || !$proceso) {
            return [
                "status" => 404,
                "message" => "Archivo o Proceso no encontrado"
            ];
        }

        $ruta = public_path('/storage/imagenes/' . $archivo->imagen_titulacion);

        if (file_exists($ruta)) {
            if (unlink($ruta)) {
                $archivo->imagen_titulacion = null;
                $proceso->carga_imagen = 0;

                $archivo->save();
                $proceso->save();

                return [
                    "status" => 200,
                    "message" => "Imágen Eliminada"
                ];
            } else {
                return [
                    "status" => 500,
                    "message" => "Error al eliminar el archivo del sistema"
                ];
            }
        } else {
            return [
                "status" => 404,
                "message" => "Archivo no encontrado en el sistema de archivos"
            ];
        }
    }
}
