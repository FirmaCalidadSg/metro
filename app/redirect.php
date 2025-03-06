<?php
/**FirmaCalidad */
$tenantId = "7258c2e3-77e9-4639-b8c0-b0ce37f72218";
$clientId = "a05de9cb-0cf4-4f44-9f89-94a5fd88f960";
$clientSecret = "UZr8Q~k8uws6AamJReZzMvAXWiIbOzQdYqMylbBa";  // Usa el **valor del secreto**, NO el ID

/**teamFood */
// $tenantId = "7b99514b-2c6e-47f0-8e95-f99ecc22f148";
// $clientId = "784e35de-c7a5-4899-a92f-4b9ededb4984";
// $clientSecret = "pB78Q~57KEoj8CVU29hKnGA1to7W~mgTxP47gcM~";  // Usa el **valor del secreto**, NO el ID

$redirectUri = "http://localhost/metro/app/redirect.php";
$redirectUri2 = "http://localhost/metro/app/loginAuth";
$tokenUrl = "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/token";
session_start();
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $postFields = [
        "client_id" => $clientId,
        "client_secret" => $clientSecret,
        "code" => $code,
        "redirect_uri" => $redirectUri,
        "grant_type" => "authorization_code",
        "scope" => "openid profile email"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $jsonResponse = json_decode($response, true);

    if ($httpCode != 200) {
        echo "<h3>Error al obtener el token</h3>";
        echo "<pre>";
        print_r($jsonResponse);
        echo "</pre>";
        exit();
    }

    if (isset($jsonResponse["access_token"])) {
        echo "<h3>Token obtenido correctamente</h3>";
        echo "<pre>";
        print_r($jsonResponse);
        echo "</pre>";
        $_SESSION['jsonResponse'] = $jsonResponse;
        header("Location: $redirectUri2");
        exit();
    } else {
        echo "Error desconocido.";
    }
} else {
    echo "No se recibió código de autorización.";
}
