<?php

namespace App\Controllers;


use App\Models\Producto;

class ProductoController
{
    public $producto;

    public function __construct()
    {
        $this->producto = new Producto();
    }

    public function index()
    {

        $productos = $this->producto->getAllProducto();

        require_once __DIR__ . '/../views/layouts/configuracion.php';
        require_once __DIR__ . '/../views/producto/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $producto = new Producto();
        if (isset($_POST['id'])) {
            $producto = $this->producto->getProductoById($_POST['id']);
        }
        require_once __DIR__ . '/../views/producto/registro.php';
    }

    public function crear()
    {
        $message = 'Producto registrado exitosamente';
        $producto = new Producto();
        $producto->id = $_POST['id'];
        $producto->nombre = $_POST['nombre'];
        $producto->codigo = $_POST['codigo'];
        $producto->descripcion = $_POST['descripcion'];

        if ($producto->id > 0) {
            $this->producto->updateProducto($producto);
            $message = 'Producto actualizado exitosamente';
        } else {
            $this->producto->createProducto($producto);
        }
        $response = [
            'success' => true,
            'message' => $message
        ];
        echo json_encode($response);
    }
    public function eliminar($id = null)
    {
        try {
            // Verificar si el ID viene en la URL
            if ($id === null) {
                // Si no viene en la URL, intentar obtenerlo del POST
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'] ?? null;
            }

            if ($id === null) {
                throw new \Exception('ID no proporcionado');
            }

            // Eliminar el producto
            $this->producto->deleteProducto($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
