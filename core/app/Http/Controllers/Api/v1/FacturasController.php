<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\factura;
use \App\Models\facturasDetalle;
use \App\Models\producto;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\ResponseController;

class FacturasController extends Controller
{
    public $response;

    public function __construct(){
        $this->response = new ResponseController;
    }

    public function index()
    {
        return $this->response->sendResponse(factura::all(), "success");
    }

    public function show($id)
    {
        $data = factura::find($id);

        $facturaDetalle = $this->facturaDetalle($id);

        if (is_null($data)) {
            return $this->response->sendError("Recurso no encontrado", 401);
        }

        return $this->response->sendResponse([
                "factura" => $data,
                "facturaDetalle" => $facturaDetalle,
            ], "success"
        );
    }

    private function facturaDetalle($id)
    {
        $data = factura::find($id)->detalle;

        if (is_null($data)) {
            return [];
        }

        return $data;
    }

    public function store(Request $request)
    {
        $factura = factura::create([
            'nitVendedor' => $request->nitVendedor,
            'nombreVendedor' => $request->nombreVendedor,
            'nitComprador' => $request->nitComprador,
            'nombreComprador' =>  $request->nombreComprador,
            'price' =>  $request->price,
            'iva' =>  $request->iva,
            'estado' => 'P'
        ]);

        return $this->response->sendResponse($factura, "success");
    }

    private function validateStore(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'isAdmin' => 'required',
            'estado' => 'required',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = factura::find($id);
        if (is_null($data)) {
            return $this->response->sendError("Recurso no encontrado", 401);
        }

        $data->nitVendedor = $request->nitVendedor;
        $data->nombreVendedor = $request->nombreVendedor;
        $data->nitComprador = $request->nitComprador;
        $data->nombreComprador = $request->nombreComprador;
        $data->price = $request->price;
        $data->iva = $request->iva;
        $data->total = $request->total;
        $data->estado = $request->estado;
        $data->save();

        return $this->response->sendResponse($data, "success");
    }

    public function destroy($id)
    {
        $data = factura::find($id);

        if (is_null($data)) {
            return $this->response->sendError("Recurso no encontrado", 401);
        }

        $data->delete();

        return $this->response->sendResponse("Factura se elimino con exito", "success");
    }

    public function productoByFactura($id){
        return $this->response->sendResponse($this->facturaDetalle($id), "success");
    }
}