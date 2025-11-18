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

    public function imagenStore(ImagenRequest $request) {
        $data = $request->validated();

        $proceso = Proceso::find($data["id"]);
        $archivo = Archivo::find($data["id"]);

        $nombre = Str::random(40) . '.' . $request->file('imagen')->getClientOriginalExtension();
        $path = $request->file('imagen')->storeAs('imagenes/', $nombre, 'public');

        $proceso->carga_imagen = 2;
        $archivo->imagen_titulacion = $nombre;

        $proceso->save();
        $archivo->save();

        return [
            "status" => 200,
            "message" => "Imágen Registrada"
        ];
    }

    public function memoriaDestroy($id) {
        $archivo = Archivo::find($id);
        $proceso = Proceso::find($id);
        Storage::delete('/pdfs/memorias/' . $archivo->memoria_estadia);
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
        Storage::delete('/pdfs/comprobantes/' . $archivo->comprobante_donacion);
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
        Storage::delete('/imagenes/titulacion/' . $archivo->imagen_titulacion);
        $archivo->imagen_titulacion = null;
        $proceso->carga_imagen = 0;
        $archivo->save();
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Imágen Eliminada"
        ];
    }
}
