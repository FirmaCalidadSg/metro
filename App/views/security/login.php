<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../App/Assets/css/globals.css" />
    <link rel="stylesheet" href="../App/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../App/Assets/css/style.css" />
    <script>
        // Redirección después de 3 segundos (ajustable)
        setTimeout(() => {
            window.location.href = "<?php 
                $tenantId = '7258c2e3-77e9-4639-b8c0-b0ce37f72218';
                $clientId = 'a05de9cb-0cf4-4f44-9f89-94a5fd88f960';
                // $redirectUri = 'http://localhost/metro/app/redirect.php';
                $redirectUri = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/Metro/App/redirect.php";

                $scope = 'openid profile email';

                echo 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/authorize?'
                    . 'client_id=' . $clientId
                    . '&response_type=code'
                    . '&redirect_uri=' . urlencode($redirectUri)
                    . '&scope=' . urlencode($scope)
                    . '&response_mode=query';
            ?>";
        }, 3000); // Cambia 3000 por el tiempo en milisegundos que quieras
    </script>
</head>
<body>
    <div class="alianza-metro">
        <div class="logo-container">
            <div id="rotatingLogo" class="rotating-logo">
                <img src="../App/Assets/css/images/animate-logo.svg" alt="logo1" class="logo-img">
            </div>
            <div id="finalLogo" class="final-logo">
                <img src="../App/Assets/css/images/animate-logo11.svg" alt="logo11">
            </div>
        </div>
    </div>
</body>
</html>
