<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MimMarcelo\API\ContaContas\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use MimMarcelo\API\ContaContas\Model\Helper\ValidateFields;
/**
 * Description of BaseController
 *
 * @author Marcelo Júnior
 */
abstract class BaseController extends Controller
{
    private $model;

    public function __construct(string $model) {
        $this->model = $model;
    }
    
    public function index(Request $request) {
        return $this->model::paginate($request->page);
    }
    
    public function store(Request $request) {
        if((new $this->model()) instanceof ValidateFields){
            $this->validate($request, $this->model::validateFields());
        }
        
        $recurso = $this->model::create($request->all());
        if(is_null($recurso)){
            return response()->json("Não foi possível criar o recurso", 400);
        }
        
        return response()->json($recurso, 201);
    }
    
    public function show(int $id) {
        $recurso = $this->model::find($id);
        if(is_null($recurso)){
            return response()->json("Recurso não encontrado", 400);
        }
        
        return response()->json($recurso);
    }
    
    public function update(int $id, Request $request) {
        if((new $this->model()) instanceof ValidateFields){
            $this->validate($request, $this->model::validateFields());
        }
        
        $recurso = $this->model::find($id);
        if(is_null($recurso)){
            return response()->json("Recurso não encontrado", 400);
        }
        
        $recurso->fill($request->all());
        $recurso->save();
        
        return response()->json($recurso);
    }
    
    public function destroy(int $id) {
        $recurso = $this->model::find($id);
        if(is_null($recurso)){
            return response()->json("Recurso não encontrado", 400);
        }
        
        $recurso->delete();
        return response()->json($recurso);
    }
}
