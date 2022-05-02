<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Producto;
use App\Http\Controllers\Api\ResponseController;

class ProductosController extends Controller
{
    public $response;

    public function __construct(){
        $this->response = new ResponseController;
    }

    public function index()
    {
        return $this->response->sendResponse(Producto::all(), "success");
    }
}