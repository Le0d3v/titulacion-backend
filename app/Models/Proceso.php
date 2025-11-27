<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $fillable = [
        "validacion_memoria_estadia",
        "validacion_datos_personales",
        "encuesta_egresados",
        "carga_imagen",
        "pago_donacion",
        "pago_titulo",
        "completado"
     ];
     
    public function validarCompletado(){
        if(
            $this->validacion_memoria_estadia == 1 &&
            $this->validacion_datos_personales == 1 &&
            $this->encuesta_egresados == 1 &&
            $this->carga_imagen == 1 &&
            $this->pago_donacion == 1 &&
            $this->pago_titulo == 1 
        ) {
            $this->completado = 1;
            $this->save();
        } else {
            $this->completado = 0;
            $this->save();
        }
    }
}
