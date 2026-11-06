<?php
// Rutas REST + endpoint interno para gRPC
use App\Http\Controllers\Api\ProductoController;
use App\Models\Producto as ProductoInterno;
use Illuminate\Http\Request as RequestInterno;
use Illuminate\Support\Facades\Route;

// CRUD REST
Route::apiResource('productos', ProductoController::class);

// Endpoint interno protegido para gRPC
Route::get('/interno/productos/{producto}', function (RequestInterno $request, ProductoInterno $producto) {
    $clave = (string) env('GRPC_INTERNAL_KEY', '');
    abort_if($clave === '' || !hash_equals($clave, (string) $request->header('X-Internal-Key')), 403);
    return response()->json($producto);
});
