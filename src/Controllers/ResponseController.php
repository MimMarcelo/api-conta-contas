<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MimMarcelo\API\ContaContas\Controllers;

use Laravel\Lumen\Routing\Controller;
/**
 * Description of ResponseController
 *
 * @author Marcelo Júnior
 */
class ResponseController extends Controller
{
    protected function responseData(object $data, int $status = 200) {
        return response()->json(['data' => $data], $status);
    }
    
    protected function responseError(string $message, int $status = 400) {
        return response()->json(['error' => $message], $status);
    }
}
