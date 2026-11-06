<?php
// Modelo Eloquent para productos
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Campos asignables masivamente
    protected $fillable = ['nombre', 'precio', 'stock'];

    // Tipado al leer
    protected $casts = [
        'precio' => 'decimal:2',
        'stock'  => 'integer',
    ];
}
