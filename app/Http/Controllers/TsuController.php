<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Models\User;
use Illuminate\Http\Request;

class TsuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new StudentCollection(
        User::where('admin', 0)
            ->whereHas('datos_escolares', function($query) {
                $query->where('cuatrimestre', 6);
            })
            ->orderBy('id', 'ASC')
            ->get()
        );
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
