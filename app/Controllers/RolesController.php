<?php

namespace App\Controllers;

use App\Models\Roles;

class RolesController
{
    private $roles;

    public function __construct()
    {
        $this->roles = new Roles();
    }

    public function index()
    {
        $roles = $this->roles->getAllRoles();
        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/roles/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    public function registro() {
    // $roles = new Roles();
        // $roles = $roles->getRolById($_GET['id']);
        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/roles/registro.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    public function crear() {}
    public function eliminar() {}
}
