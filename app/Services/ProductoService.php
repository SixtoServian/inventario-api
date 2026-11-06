<?php
// Lógica centralizada para REST y GraphQL
namespace App\Services;

use App\Events\ProductoActualizado;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;

class ProductoService
{
    // Listado ordenado por ID
    public function listar()
    {
        return Producto::orderBy('id')->get();
    }

    // Buscar o lanzar 404
    public function buscar(int $id): Producto
    {
        return Producto::findOrFail($id);
    }

    // Crear con validación centralizada
    public function crear(array $datos): Producto
    {
        $datos = Validator::make($datos, [
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
        ])->validate();

        $producto = Producto::create($datos);
        // Dispara evento para Reverb
        event(new ProductoActualizado($producto, 'creado'));
        return $producto;
    }

    // Actualizar campos opcionales
    public function actualizar(Producto $producto, array $datos): Producto
    {
        $datos = Validator::make($datos, [
            'nombre' => 'sometimes|required|string|max:100',
            'precio' => 'sometimes|required|numeric|min:0',
            'stock'  => 'sometimes|required|integer|min:0',
        ])->validate();

        $producto->update($datos);
        event(new ProductoActualizado($producto, 'actualizado'));
        return $producto->refresh();
    }

    // Atajo para stock (usado por GraphQL)
    public function cambiarStock(Producto $producto, int $stock): Producto
    {
        return $this->actualizar($producto, ['stock' => $stock]);
    }

    // Eliminar
    public function eliminar(Producto $producto): void
    {
        $producto->delete();
    }
}
