<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new StudentCollection(User::where("admin", 0)->orderBy("id", "ASC")->get());
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
    public function show(string $id)
    {
        if(!$id) {
            return response([
                "Respuesta" => "Usuario No encontrado",
                "error" => 404,
            ]);
        }

        return new StudentCollection(User::where("id", $id)->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
