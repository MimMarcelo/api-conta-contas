<?php

namespace MimMarcelo\API\ContaContas\Controllers;

use Illuminate\Http\Request;
use MimMarcelo\API\ContaContas\Model\Helper\ValidateFields;
/**
 * Description of BaseController
 *
 * @author Marcelo Júnior
 */
abstract class BaseController extends ResponseController
{
    private $model;
    private $usuario_id;

    public function __construct(string $model) {
        $this->model = $model;
        $this->usuario_id = auth()->user()->id;
    }
    
    public function index(Request $request) {
        if(isset($request->page)){
            if(!isset($request->per_page)){
                $request->per_page = 15;
            }
            $per_page = $request->per_page;
            $data = $this->model::paginate($per_page);
            $data->appends(['per_page' => $per_page]);
            return $data;
        }
        return $this->responseData($this->model::where('usuario_id', '=', $this->usuario_id)->get());
    }
    
    public function store(Request $request) {
        if((new $this->model()) instanceof ValidateFields){
            $this->validate($request, $this->model::validateFields());
        }
        
        $recurso = $this->model::create($this->getParametros($request));
        if(is_null($recurso)){
            return $this->responseError("Não foi possível criar o recurso");
        }
        
        return $this->responseData($recurso, 201);
    }
    
    public function show(int $id) {
        $recurso = $this->getRecurso($id);
        if(is_null($recurso)){
            return $this->responseError("Recurso não encontrado");
        }
        
        return $this->responseData($recurso);
    }
    
    public function update(int $id, Request $request) {
        if((new $this->model()) instanceof ValidateFields){
            $this->validate($request, $this->model::validateFields());
        }
        
        $recurso = $this->getRecurso($id);
        if(is_null($recurso)){
            return $this->responseError("Recurso não encontrado");
        }
        
        $recurso->fill($this->getParametros($request));
        $recurso->save();
        
        return $this->responseData($recurso);
    }
    
    public function destroy(int $id) {
        $recurso = $this->getRecurso($id);
        if(is_null($recurso)){
            return $this->responseError("Recurso não encontrado");
        }
        
        $recurso->delete();
        return $this->responseData($recurso);
    }
    
    private function getRecurso(int $id) {
        return $this->model::where('usuario_id', '=', $this->usuario_id)->where('id', '=', $id)->first();
    }
    
    private function getParametros(Request $request) {
        $params = $request->input();
        $params['usuario_id'] = $this->usuario_id;
        return $params;
    }
}
