<?php

namespace App\Controllers;

use App\Models\Linea;
use App\Models\Proceso;
use App\Models\Plantas;
use App\Models\UnidadMedida;


class LineaController
{
    private $linea;
    private $proceso;
    private $planta;
    private $unidad;


    public function __construct()
    {
        $this->linea = new Linea();
        $this->proceso = new Proceso();
        $this->planta = new Plantas();
        $this->unidad = new UnidadMedida();
    }

    public function index()
    {
        $lineas = $this->linea->getAllLineas();


        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/linea/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $linea = new Linea();
        $procesos = $this->proceso->getAllproceso();
        $plantas = $this->planta->getAllPlantas();
        $unidad = $this->unidad->getAllUnidadesMedida();

        if (isset($_REQUEST['id'])) {
            $linea = $this->linea->getLineaById($_REQUEST['id']);
        }

        require_once __DIR__ . '/../views/linea/registro.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function crear()
    {
        //print_r($_REQUEST['procesos']);
        $linea = new Linea();
        $linea->id = $_POST['id'] ?? null;
        $linea->nombre = $_POST['nombre'];
        $linea->proceso = "null";
        $linea->planta_id = $_POST['planta_id'];
        $linea->tipo_unidad = $_POST['tipo_unidad'];
        $linea->citg = $_POST['citg'];
        $linea->citr = $_POST['citr'];
        $linea->supervisor = $_POST['supervisor'];

        $result = $linea->id > 0 ? $this->linea->updateLinea($linea) : $this->linea->createLinea($linea);
        $linea->id > 0 ? $linea_id = $linea->id : $linea_id = $result['id'];
        if ($result) {
            $proceso = $_POST['procesos'];



            foreach ($proceso as $id) {
                // Leer el valor del array $proceso
                $this->linea->agregarProcesos($id, $linea_id);
            }
        }

        echo json_encode($result);
    }

    public function eliminar($id)
    {
        echo json_encode(['success' => $this->linea->deleteLinea($id)]);
    }

    public function getbyplanta()
    {
        $lineas =  $this->linea->GetByPlanta($_REQUEST['planta']);
        echo json_encode($lineas);
    }

    
}
