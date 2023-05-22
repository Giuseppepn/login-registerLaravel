<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Utente;
use App\Http\Controllers\Controller;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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




        // Store the user...

        try{
            $utenteReg = new Utente;
            if(($user = Utente::where('username', $request->user)->first()) == null)
            {

                $utenteReg->username = $request->user;
                $utenteReg->password = Hash::make($request->password);
                $utenteReg->email = $request->email;

                $utenteReg->save();

                return response()->json(status: 200,data: ['OK!']);
            }
            else
            {
                return response()->json(status: 400,data: $user);
            }
        }catch(Exception $e){
            return response()->json(status: 400,data: $user);
        }

    }


    public function leggiToken(Request $request)
    {
        $key = env('JWT_KEY');

        $token = (string) $request->token;
        try {
            $decoded_jwt = JWT::decode($token, new Key($key, 'HS256'));
            return response()->json(status : 212, data : $decoded_jwt);
        } catch (Exception $e) {
            return response()->json(status : 400, data : $token);
        }

    }



    private function creaToken($data)
    {
        $key = env('JWT_KEY');
        $userData = $data->toArray();
        $jwt = JWT::encode($userData, $key, 'HS256');
        return $jwt;
    }



    public function login(Request $request)
    {



        try{
            $request->has('user');
            if($user = Utente::where('username', $request->user)->first())
            {

                if(Hash::check($request->password,$user->password))
                {
                    $data = [
                        'user' => $user,
                        'token' => $this->creaToken($user)
                    ];

                    return response()->json(status: 212,data: $data);


                }
            }
        }catch(Exception $e){
            return response()->json(status: 400,data: $user);
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
