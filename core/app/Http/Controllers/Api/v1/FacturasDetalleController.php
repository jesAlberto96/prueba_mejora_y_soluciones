<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\facturasDetalle;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\ResponseController;

class FacturasDetalleController extends Controller
{
    public $response;

    public function __construct(){
        $this->response = new ResponseController;
    }

    public function store(Request $request)
    {
        $this->validateStore($request);

        $facturaDetalle = facturasDetalle::create([
            'factura_id' => $request->factura_id,
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'observaciones' => $request->observaciones,
        ]);

        return $this->response->sendResponse($facturaDetalle, "success");
    }

    private function validateStore(Request $request){
        $this->validate($request, [
            'factura_id' => 'required',
            'producto_id' => 'required',
            'cantidad' => 'required',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = facturasDetalle::find($id);
        if (is_null($data)) {
            return $this->response->sendError("Recurso no encontrado", 401);
        }

        $data->cantidad = $request->cantidad;
        $data->observaciones = $request->observaciones;
        $data->save();

        return $this->response->sendResponse($data, "success");
    }

    public function destroy($id)
    {
        $data = facturasDetalle::find($id);

        if (is_null($data)) {
            return $this->response->sendError("Recurso no encontrado", 401);
        }

        $data->delete();

        return $this->response->sendResponse("El detalle se elimino con exito", "success");

    }
}