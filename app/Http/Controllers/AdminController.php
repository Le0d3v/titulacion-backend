<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminCollection;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new AdminCollection(User::where("admin", 1)->orderBy("id", "DESC")->get());
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
    public function show(User $user)
    {
        $id = $user->id;

        if(!$id) {
            return json_encode("Usuario No encontrado");
        }
        
        $student = User::find($id);
        return $student->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
