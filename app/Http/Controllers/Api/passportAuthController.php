<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class passportAuthController extends Controller
{
    /**
     * @param Request $request
     * 
     */
    public function inscription(UserRequest $request){
        $validated = $request->validated();
        $user= User::create([
            'prenom' =>$request->prenom,
            'nom' =>$request->nom,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        $token = $user->createToken('PassportToken')->accessToken;
        return response()->json(['message'=>'inscription réussie'],200);
    }

    /**
     * @param Request $request
     * 
     */
    public function connexion (Request $request){
        $login_infos=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($login_infos)){
            
            $connex_client_token= auth()->user()->createToken('PassportToken')->accessToken;
          
            return response()->json(['message' => 'Bienvenue'], 200);
        }
        else{
            return response()->json(['Erreur' => 'Erreur'], 401);
        }
    }

}
