<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_PATH; ?>/dashboard">Metro Team</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario'] ?? 'Usuario'); ?></span>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/usuarios">Gestión de Usuarios</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/roles">Gestión de Roles</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Configuración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/definicion">Definicion</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/paises">Paises</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/ciudades">Ciudad</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/departamentos">Departamentos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/equipos">Equipos</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/daños">Daños</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/procesos">Procesos</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/lineas">Lineas</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/productos">Productos</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/lineaproductos">Linea y Productos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?> /paros">Paros</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/subparos">Sub-Paros</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/turnos">Turnos</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_PATH; ?>/documentos">Todos Los Documentos</a></li>
                    </li>
                </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_PATH; ?>/capacidades">Control de Capacidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_PATH; ?>/consultas">Consultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_PATH; ?>/capacidades">Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_PATH; ?>/logout">Cerrar Sesión</a>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>