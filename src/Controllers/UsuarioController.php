<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MimMarcelo\API\ContaContas\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MimMarcelo\API\ContaContas\Model\Usuario;
/**
 * Description of UserController
 *
 * @author Marcelo Júnior
 */
class UsuarioController extends ResponseController
{    
    public function index()
    {
        return "Bem vindo à API do sistema ContaConta$";
    }
    
    public function login(Request $request) {
        $this->validate($request, Usuario::validateFields());
        
        $usuario = Usuario::where('email', $request->email)->first() ;
        if(is_null($usuario) || !Hash::check($request->password, $usuario->password)){
            return response()->json("Usuário ou senha inválidos", 401);
        }
        $token = JWT::encode(
                ["email" => $request->email], 
                env("JWT_KEY")
        );
        
        return [
            "access_token" => $token
        ];
    }
}
