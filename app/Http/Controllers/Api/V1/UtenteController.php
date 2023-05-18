<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Utente;
use App\Http\Controllers\Controller;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return response()->json(Utente::all());
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $utenteReg = new Utente;
            $utenteReg->username = $request->user;
            $utenteReg->password = Hash::make($request->password);
            $utenteReg->email = $request->email;

            $utenteReg->save();
            $utente = $request->utente;
            return response()->json(status: 200,data: ['OK!']);



        // Store the user...


    }

    public function login(Request $request)
    {



        try{
            $request->has('user');
            if($user = Utente::where('username', $request->user)->first())
            {
                if(Hash::check($request->password,$user->password))
                {
                    return response()->json(status: 212,data: ['Login Avvenuto!']);
                }
            }
        }catch(Exception $e){
            return response()->json(status:410, data: ['ERRORE']);
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Utente $utente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utente $utente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utente $utente)
    {
        //
    }
}
