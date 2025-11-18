<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentCollection;
use App\Models\Proceso;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

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
    public function update(StudentRequest $request, $id)
    {
        $data = $request->validated();

        $user = User::find($id);
        $proceso = Proceso::find($id);

        $user->name = $data["name"];
        $user->apellido_paterno = $data["apellido_paterno"];
        $user->apellido_materno = $data["apellido_materno"];
        $user->fecha_nacimiento = $data["fecha_nacimiento"];
        $user->curp = $data["curp"];
        $user->rfc = $data["rfc"];
        $user->genero = $data["genero"];
        $user->estado_civil = $data["estado_civil"];
        $user->email = $data["email"];
        $user->telefono = $data["telefono"];
        $user->telefono_emergencia_1 = $data["telefono_emergencia_1"];
        $user->telefono_emergencia_2 = $data["telefono_emergencia_2"];
        $user->save();

        $proceso->validacion_datos_personales = 1;
        $proceso->save();

        return [
            "status" => 200,
            "message" => "Datos Actualizados"
        ];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
