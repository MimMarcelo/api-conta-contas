<?php

namespace MimMarcelo\API\ContaContas\Middleware;

use MimMarcelo\API\ContaContas\Model\Usuario;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class Autenticador {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next) {
        try {
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }
            $authorizationHeader = $request->header("Authorization");
            $token = str_replace("Bearer ", '', $authorizationHeader);

            $dadosAutenticacao = JWT::decode($token, env("JWT_KEY"), ["HS256"]);

            $user = Usuario::where('email', $dadosAutenticacao->email)->first();

            if (is_null($user)) {
                throw new \Exception();
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json("Não autorizado", 401);
        }
    }

}
