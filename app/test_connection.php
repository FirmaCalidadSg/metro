<?php
require_once 'config/config.php';
require_once 'config/Database.php';

use App\Config\Database;

try {
    $result = Database::testConnection();
    echo "<h2>Prueba de Conexión</h2>";
    echo "<pre>";
    print_r($result);
    echo "</pre>";
    
    if ($result['success']) {
        echo "<p style='color:green'>✓ Conexión exitosa</p>";
        echo "<p>Versión SQL Server: " . $result['version'] . "</p>";
    } else {
        echo "<p style='color:red'>✗ Error de conexión</p>";
        echo "<p>Error: " . $result['message'] . "</p>";
    }
} catch (Exception $e) {
    echo "<h2>Error</h2>";
    echo "<p style='color:red'>" . $e->getMessage() . "</p>";
}

// Debug adicional
echo "<h3>Información del Sistema</h3>";
echo "<pre>";
print_r([
    'PHP Version' => phpversion(),
    'PDO Drivers' => PDO::getAvailableDrivers(),
    'sqlsrv extensión' => extension_loaded('sqlsrv') ? 'Instalada' : 'No instalada',
    'pdo_sqlsrv extensión' => extension_loaded('pdo_sqlsrv') ? 'Instalada' : 'No instalada'
]);
echo "</pre>"; 