<?php
session_start();

// Configuraci車n de credenciales de Microsoft
$tenantId = "7258c2e3-77e9-4639-b8c0-b0ce37f72218";
$clientId = "a05de9cb-0cf4-4f44-9f89-94a5fd88f960";
$clientSecret = "UZr8Q~k8uws6AamJReZzMvAXWiIbOzQdYqMylbBa"; // Secreto de cliente

// Configurar URIs de redirecci車n din芍micamente
$scheme = $_SERVER['REQUEST_SCHEME']; // http o https
$host = $_SERVER['HTTP_HOST'];

if ($host === "localhost") {
    $redirectUri = "http://localhost/metro/app/redirect.php";
    $redirectUri2 = "http://localhost/metro/app/loginAuth";
} else {
    $redirectUri = "$scheme://$host/Metro/App/redirect.php";
    $redirectUri2 = "$scheme://$host/Metro/App/loginAuth";
}

// Validar si recibimos el c車digo de autorizaci車n
$code = filter_input(INPUT_GET, 'code', FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

if (!$code) {
    die("No se recibi車 el c車digo de autorizaci車n.");
}

// URL para obtener el token
$tokenUrl = "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/token";

// Par芍metros para la solicitud de token
$postFields = [
    "client_id" => $clientId,
    "client_secret" => $clientSecret,
    "code" => $code,
    "redirect_uri" => $redirectUri,
    "grant_type" => "authorization_code",
    "scope" => "openid profile email"
];

// Inicializar cURL y realizar la solicitud
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $tokenUrl,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($postFields),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => true, // Asegura conexi車n segura
    CURLOPT_TIMEOUT => 30 // Evita bloqueos largos
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Decodificar respuesta JSON
$jsonResponse = json_decode($response, true);

// Manejo de errores si la solicitud falla
if ($httpCode !== 200 || !isset($jsonResponse["access_token"])) {
    $_SESSION['error_token'] = $jsonResponse;
    header("Location: /Metro/App/error.php"); // P芍gina de error espec赤fica
    exit();
}

// Guardar respuesta en sesi車n y redirigir
$_SESSION['jsonResponse'] = $jsonResponse;
header("Location: $redirectUri2");
exit();
?>

