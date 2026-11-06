# Inventario API — Laboratorio

## Stack
- Laravel 13.40 / PHP 8.4.27 / SQLite
- REST · GraphQL (Lighthouse 6.74) · WebSockets (Reverb 1.12)
- gRPC: pendiente por límite de tiempo

## Endpoints REST
- GET    /api/productos
- POST   /api/productos
- GET    /api/productos/{id}
- PATCH  /api/productos/{id}
- DELETE /api/productos/{id}

## GraphQL (POST /graphql)
Query:    { productos { id nombre precio stock } }
Mutation: mutation { crearProducto(nombre:"X", precio:1, stock:1) { id } }
Mutation: mutation { actualizarStock(id:1, stock:8) { id stock } }

## WebSockets
- Canal: inventario
- Evento: producto.actualizado
- Vista: http://127.0.0.1:8000/inventario

## Arranque (4 terminales)
1. php artisan serve
2. php artisan queue:work
3. php artisan reverb:start
4. npm run dev

## Estado de pruebas
- REST: OK (201/200/204)
- GraphQL: OK (query + 2 mutations)
- Reverb: OK (jobs DONE, evento recibido en 2da pestaña)
- gRPC: no implementado por tiempo
