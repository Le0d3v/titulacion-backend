<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\StudentCollection;

class IngController extends Controller
{

    public function index() {
        return new StudentCollection(
            User::where('admin', 0)
                ->whereHas('datos_escolares', function($query) {
                    $query->where('cuatrimestre', 11);
                })
                ->orderBy('id', 'ASC')
                ->get()
            );
    }
}
