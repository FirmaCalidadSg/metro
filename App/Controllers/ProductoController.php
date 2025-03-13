<?php

namespace App\Controllers;

use App\Models\Producto;
use App\Models\Linea;

class ProductoController
{
    private $producto;
    private $linea;

    public function __construct()
    {
        $this->producto = new Producto();
        $this->linea = new Linea();
    }

    public function index()
    {
        $productos = $this->producto->getAllProducto();
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/producto/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function registro()
    {
        $producto = new Producto();
        $lineas = $this->linea->getAllLineas();

        if (isset($_REQUEST['id'])) {
            $producto = $this->producto->getProductoById($_REQUEST['id']);
        }

        require_once __DIR__ . '/../views/producto/registro.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function agregarproducto()
    {
        require_once __DIR__ . '/../views/producto/agregarprodcontrol.php';
    }

    public function crear()
    {
        $producto = new Producto();
        $producto->id = $_POST['id'] ?? null;
        $producto->linea_id = $_POST['linea_id'];
        $producto->nombre = $_POST['nombre'];
        $producto->codigo = $_POST['codigo'];
        $producto->descripcion = $_POST['descripcion'] ?? null;

        $result = $producto->id > 0 ? $this->producto->updateProducto($producto) : $this->producto->createProducto($producto);
        echo json_encode($result);
    }

    public function eliminar($id)
    {
        echo json_encode(['success' => $this->producto->deleteProducto($id)]);
    }
}
