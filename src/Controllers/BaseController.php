<?php

namespace MimMarcelo\API\ContaContas\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use MimMarcelo\API\ContaContas\Model\Helper\ValidateFields;
/**
 * Description of BaseController
 *
 * @author Marcelo Júnior
 */
abstract class BaseController extends ResponseController
{
    private $model;

    public function __construct(string $model) {
        $this->model = $model;
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
        return $this->responseData($this->model::all());
    }
    
    public function store(Request $request) {
        if((new $this->model()) instanceof ValidateFields){
            $this->validate($request, $this->model::validateFields());
        }
        
        $recurso = $this->model::create($request->all());
        if(is_null($recurso)){
            return $this->responseError("Não foi possível criar o recurso");
        }
        
        return $this->responseData($recurso, 201);
    }
    
    public function show(int $id) {
        $recurso = $this->model::find($id);
        if(is_null($recurso)){
            return $this->responseError("Recurso não encontrado");
        }
        
        return $this->responseData($recurso);
    }
    
    public function update(int $id, Request $request) {
        if((new $this->model()) instanceof ValidateFields){
            $this->validate($request, $this->model::validateFields());
        }
        
        $recurso = $this->model::find($id);
        if(is_null($recurso)){
            return $this->responseError("Recurso não encontrado");
        }
        
        $recurso->fill($request->all());
        $recurso->save();
        
        return $this->responseData($recurso);
    }
    
    public function destroy(int $id) {
        $recurso = $this->model::find($id);
        if(is_null($recurso)){
            return $this->responseError("Recurso não encontrado");
        }
        
        $recurso->delete();
        return $this->responseData($recurso);
    }
}
