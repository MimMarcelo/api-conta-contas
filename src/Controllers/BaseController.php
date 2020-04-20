<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MimMarcelo\API\ContaContas\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

/**
 * Description of $this->controllersController
 *
 * @author Marcelo Júnior
 */
abstract class BaseController extends Controller
{
    /** @var \Laravel\Lumen\Routing\Controller $controller */
    private $controller;

    public function __construct(string $controller) {
        $this->controller = $controller;
    }

    public abstract function camposParaValidar(): array;
    
    public function index(Request $request) {
        return $this->controller::paginate($request->page);
    }
    
    public function store(Request $request) {
        $this->validate($request, $this->camposParaValidar());
//        var_dump($request);
//        exit();
        $recurso = $this->controller::create($request->all());
        if(is_null($recurso)){
            return response()->json("Não foi possível criar o recurso", 400);
        }
        
        return response()->json($recurso, 201);
    }
    
    public function show(int $id) {
        $recurso = $this->controller::find($id);
        if(is_null($recurso)){
            return response()->json("Recurso não encontrado", 400);
        }
        
        return response()->json($recurso);
    }
    
    public function update(int $id, Request $request) {
        $this->validate($request, $this->camposParaValidar());
        
        $recurso = $this->controller::find($id);
        if(is_null($recurso)){
            return response()->json("Recurso não encontrado", 400);
        }
        
        $recurso->fill($request->all());
        $recurso->save();
        
        return response()->json($recurso);
    }
    
    public function destroy(int $id) {
        $recurso = $this->controller::find($id);
        if(is_null($recurso)){
            return response()->json("Recurso não encontrado", 400);
        }
        
        $recurso->delete();
        return response()->json($recurso);
    }
}
