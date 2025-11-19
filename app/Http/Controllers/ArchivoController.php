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

        $proceso = Proceso::findOrFail($data["id"]);
        $archivo = Archivo::findOrFail($data["id"]);
        $user = User::findOrFail($data["id"]);

        $nombreArchivo = "memoria_estadia_{$user->matricula}.pdf";
        $rutaFisica = public_path("storage/pdfs/memorias");

        if (!file_exists($rutaFisica)) {
            mkdir($rutaFisica, 0775, true);
        }

        $rutaArchivo = $rutaFisica . "/" . $nombreArchivo;

        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        $request->file("pdf")->move($rutaFisica, $nombreArchivo);

        $proceso->validacion_memoria_estadia = 2;
        $archivo->memoria_estadia = $nombreArchivo;

        $proceso->save();
        $archivo->save();

        return [
            "status" => 200,
            "message" => "Archivo registrado correctamente"
        ];

    }

    public function comprobanteStore(PDFRequest $request) {
       $data = $request->validated();

        $proceso = Proceso::findOrFail($data["id"]);
        $archivo = Archivo::findOrFail($data["id"]);
        $user = User::findOrFail($data["id"]);

        $nombreArchivo = "comprobante_{$user->matricula}.pdf";
        $rutaFisica = public_path("storage/pdfs/comprobantes");

        if (!file_exists($rutaFisica)) {
            mkdir($rutaFisica, 0775, true);
        }

        $rutaArchivo = $rutaFisica . "/" . $nombreArchivo;

        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        $request->file("pdf")->move($rutaFisica, $nombreArchivo);

        $proceso->pago_donacion = 2;
        $archivo->comprobante_donacion = $nombreArchivo;

        $proceso->save();
        $archivo->save();

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

        $rutaFisica = public_path("storage/imagenes");

        if (!file_exists($rutaFisica)) {
            mkdir($rutaFisica, 0775, true);
        }

        $rutaArchivo = $rutaFisica . "/" . $nombreArchivo;

        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        $request->file("imagen")->move($rutaFisica, $nombreArchivo);

        $proceso->carga_imagen = 2;
        $archivo->imagen_titulacion = $nombreArchivo;

        $a = 0;

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

        $ruta = public_path('pdfs/memorias/' . $archivo->memoria_estadia);

        if (file_exists($ruta)) {
            unlink($ruta);
        }

        $archivo->memoria_estadia = null;
        $proceso->validacion_memoria_estadia = 0;

        $archivo->save();
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Archivo Eliminado"
        ];

    }
    public function comprobanteDestroy($id) {
        $archivo = Archivo::find($id);
        $proceso = Proceso::find($id);

        $ruta = public_path('pdfs/comprobantes/' . $archivo->comprobante_donacion);

        if (file_exists($ruta)) {
            unlink($ruta);
        }

        $archivo->comprobante_donacion = null;
        $proceso->pago_donacion = 0;

        $archivo->save();
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Archivo Eliminado"
        ];
    }

    public function imagenDestroy($id) {
        $archivo = Archivo::find($id);
        $proceso = Proceso::find($id);

        $ruta = public_path('imagenes/' . $archivo->imagen_titulacion);

        if (file_exists($ruta)) {
            unlink($ruta);
        }

        $archivo->imagen_titulacion = null;
        $proceso->carga_imagen = 0;

        $archivo->save();
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Archivo Eliminado"
        ];
    }
}
