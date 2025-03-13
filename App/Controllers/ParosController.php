<?php

namespace App\Controllers;


use App\Models\Pais;
use App\Models\TiposParos;

class ParosController
{
    public $paros;
    public $tipoParo;

    public function __construct()
    {
        $this->paros = new Pais();
        $this->tipoParo = new TiposParos();
    }

    public function index()
    {

        $paros = $this->paros->getAllPais();

        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/pais/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function registro()
    {
        $paros = new Pais();
        //print_r($_REQUEST['id']);
        if (isset($_REQUEST['id'])) {
            $paros = $this->paros->getPaisById($_REQUEST['id']);
        }

        require_once __DIR__ . '/../views/pais/registro.php';
    }

    public function crear()
    {
        $message = 'Paros registrado exitosamente';
        $paros = new Pais();
        $paros->id = $_POST['id'];
        $paros->nombre = $_POST['nombre'];
        $paros->codigo = $_POST['codigo'];

        $result = $paros->id > 0 ? $this->paros->updatePais($paros) : $this->paros->createPais($paros);
        echo json_encode($result, true);
    }
    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $response = [
                'success' => false,
                'message' => 'Método no permitido.'
            ];
            echo json_encode($response);
            exit;
        }

        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];

        // Obtener la definición por ID
        $paros = $this->paros->getPaisById($id);

        if (!$paros) {
            $response = [
                'success' => false,
                'message' => 'Paros no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }

        // Actualizar la definición
        $paros->nombre = $nombre;
        $paros->codigo = $codigo;

        // Guardar la definición actualizada
        $result = $this->paros->updatePais($paros);
        echo json_encode($result, true);
    }
    public function editarFormulario($id)
    {
        $paros = $this->paros->getPaisById($id);

        if (!$paros) {
            $response = [
                'success' => false,
                'message' => 'Paros no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/pais/editar.php';
    }

    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $paros = $this->paros->getPaisById($id);
        } else {
            header("Location: /metro/app/paros");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/pais/vista-previa.php';
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

            // Eliminar el paros
            $result = $this->paros->deletePais($id);
            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    public function Paros()/**categoriaparos */
    {

      
    }

    public function subParo()/**subcategoriaparos */
    {

    }
    public function RazonParo()/** tiposparos */
    {

    }
}
