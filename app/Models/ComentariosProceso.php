<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComentariosProceso extends Model
{
  protected $fillable = [
    "proceso_id", 
    "subproceso",
    "comentario", 
  ];
}
