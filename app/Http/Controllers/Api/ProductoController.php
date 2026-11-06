<?php
// Controlador REST de productos
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Services\ProductoService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Inyección del servicio compartido
    public function __construct(private ProductoService $servicio) {}

    // GET /api/productos
    public function index()
    {
        return response()->json($this->servicio->listar(), 200);
    }

    // POST /api/productos
    public function store(Request $request)
    {
        return response()->json($this->servicio->crear($request->all()), 201);
    }

    // GET /api/productos/{producto}
    public function show(Producto $producto)
    {
        return response()->json($producto, 200);
    }

    // PATCH /api/productos/{producto}
    public function update(Request $request, Producto $producto)
    {
        return response()->json($this->servicio->actualizar($producto, $request->all()), 200);
    }

    // DELETE /api/productos/{producto}
    public function destroy(Producto $producto)
    {
        $this->servicio->eliminar($producto);
        return response()->json(null, 204);
    }
}
