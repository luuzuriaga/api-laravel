# API de Productos y Categorías

API REST construida con **Laravel 13**, **MySQL 8.4** y **Docker (Laravel Sail)** para gestionar productos y sus categorías.

## Características

- CRUD completo de productos y categorías.
- Validación con Form Requests y mensajes en español.
- Respuestas JSON con un formato uniforme (`success`, `message`, `data`).
- Una categoría no se puede eliminar si tiene productos asociados (responde `409`).
- Registro de actividad de los modelos con `spatie/laravel-activitylog`.
- Documentación automática de la API con [Scramble](https://scramble.dedoc.co/).
- Datos de ejemplo mediante seeders.

## Requisitos

- [Docker](https://www.docker.com/) y Docker Compose
- PHP 8.3+ y Composer (solo para instalar dependencias la primera vez)

## Instalación

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/luuzuriaga/api-laravel.git
   cd api-laravel
   ```

2. Instalar dependencias:

   ```bash
   composer install
   ```

3. Crear el archivo de entorno:

   ```bash
   cp .env.example .env
   ```

4. Configurar la base de datos en `.env`:

   ```env
   APP_PORT=8088

   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=sail
   DB_PASSWORD=password
   ```

5. Levantar los contenedores:

   ```bash
   ./vendor/bin/sail up -d
   ```

6. Generar la clave de la aplicación, ejecutar migraciones y cargar datos de ejemplo:

   ```bash
   ./vendor/bin/sail artisan key:generate
   ./vendor/bin/sail artisan migrate --seed
   ```

La API quedará disponible en `http://localhost:8088/api`.

## Endpoints

### Categorías

| Método      | Ruta                    | Descripción                                   |
| ----------- | ----------------------- | --------------------------------------------- |
| `GET`       | `/api/categories`       | Lista las categorías con su número de productos |
| `POST`      | `/api/categories`       | Crea una categoría                            |
| `GET`       | `/api/categories/{id}`  | Muestra una categoría                         |
| `PUT/PATCH` | `/api/categories/{id}`  | Actualiza una categoría                       |
| `DELETE`    | `/api/categories/{id}`  | Elimina una categoría (si no tiene productos) |

### Productos

| Método      | Ruta                  | Descripción                          |
| ----------- | --------------------- | ------------------------------------ |
| `GET`       | `/api/products`       | Lista los productos con su categoría |
| `POST`      | `/api/products`       | Crea un producto                     |
| `GET`       | `/api/products/{id}`  | Muestra un producto                  |
| `PUT/PATCH` | `/api/products/{id}`  | Actualiza un producto                |
| `DELETE`    | `/api/products/{id}`  | Elimina un producto                  |

## Validaciones

**Categoría**

| Campo         | Reglas                                   |
| ------------- | ---------------------------------------- |
| `name`        | requerido, texto, máx. 255, único        |
| `description` | opcional, texto                          |

**Producto**

| Campo         | Reglas                                   |
| ------------- | ---------------------------------------- |
| `name`        | requerido, texto, máx. 255               |
| `description` | opcional, texto                          |
| `price`       | requerido, numérico, mínimo 0.01         |
| `category_id` | requerido, debe existir en `categories`  |
| `stock`       | requerido, entero, mínimo 0              |

## Ejemplos

Crear una categoría:

```bash
curl -X POST http://localhost:8088/api/categories \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"name": "Ropa", "description": "Polos y camisetas"}'
```

Crear un producto:

```bash
curl -X POST http://localhost:8088/api/products \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"name": "Polo Overskull", "description": "Camiseta negra edición limitada", "price": 89.90, "category_id": 1, "stock": 50}'
```

Respuesta exitosa:

```json
{
  "success": true,
  "message": "Producto creado correctamente",
  "data": {
    "id": 1,
    "name": "Polo Overskull",
    "description": "Camiseta negra edición limitada",
    "price": 89.9,
    "category_id": 1,
    "stock": 50
  }
}
```

Error al eliminar una categoría con productos (`409 Conflict`):

```json
{
  "success": false,
  "message": "No se puede eliminar la categoría porque tiene productos asociados",
  "errors": null
}
```

## Documentación de la API

Con los contenedores levantados, la documentación interactiva generada por Scramble está en:

```
http://localhost:8088/docs/api
```

## Tests

```bash
./vendor/bin/sail artisan test
```

## Tecnologías

- Laravel 13 / PHP 8.3+
- MySQL 8.4
- Docker con Laravel Sail
- Laravel Sanctum
- Spatie Laravel Activitylog
- Dedoc Scramble
